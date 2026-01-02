<?php
require_once '../classes/Database.php';
require_once '../classes/User.php';
require_once '../classes/Acheteur.php';
require_once '../classes/Organisateur.php';

class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function register(array $data, array $file): ?User
    {
        $nom = trim($data['firstname'] . ' ' . $data['lastname']);
        $email = trim($data['email']);
        $telephone = trim($data['phone']);
        $role = $data['role'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT);


        $photoName = "default.png";

       
        if (!empty($file['photo']['name']) && $file['photo']['error'] === 0) {
            $ext = pathinfo($file['photo']['name'], PATHINFO_EXTENSION);
            $photoName = uniqid() . '.' . $ext;

            
            $uploadPath = "../uploads/avatars/";
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            move_uploaded_file($file['photo']['tmp_name'], $uploadPath . $photoName);
        }


        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            return null; 
        }

        
        $stmt = $this->db->prepare("
            INSERT INTO users (nom, email, telephone, photo, password, role)
            VALUES (:nom, :email, :telephone, :photo, :password, :role)
        ");
        $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'telephone' => $telephone,
            'photo' => $photoName,
            'password' => $password,
            'role' => $role
        ]);

        $id = (int)$this->db->lastInsertId();


        if ($role === 'acheteur') {
            return new Acheteur($id, $nom, $email, $telephone, $photoName, $password);
        } else {
            return new Organisateur($id, $nom, $email, $telephone, $photoName, $password);
        }
    }

    public function login(string $email, string $password): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            return null;
        }

        switch ($user['role']) {
            case 'admin':
                return new Admin(
                    $user['id'],
                    $user['nom'],
                    $user['email'],
                    $user['telephone'],
                    $user['photo'],
                    $user['password']
                );

            case 'organisateur':
                return new Organisateur(
                    $user['id'],
                    $user['nom'],
                    $user['email'],
                    $user['telephone'],
                    $user['photo'],
                    $user['password']
                );

            case 'acheteur':
                return new Acheteur(
                    $user['id'],
                    $user['nom'],
                    $user['email'],
                    $user['telephone'],
                    $user['photo'],
                    $user['password']
                );
        }

        return null;
    }
    
    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];


        session_destroy();

        header("Location: ../public/login.php");
        exit;
    }
    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        if ($row['role'] === 'acheteur') {
            return new Acheteur($row['id'], $row['nom'], $row['email'], $row['telephone'], $row['photo'], $row['password']);
        } else {
            return new Organisateur($row['id'], $row['nom'], $row['email'], $row['telephone'], $row['photo'], $row['password']);
        }
    }
}
