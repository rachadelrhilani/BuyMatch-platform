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

        
        $photoName = $data['photo'];
        if (!empty($file['photo']['name'])) {
            $ext = pathinfo($file['photo']['name'], PATHINFO_EXTENSION);
            $photoName = uniqid() . '.' . $ext;
            move_uploaded_file($file['photo']['tmp_name'], "../uploads/avatars/$photoName");
        }

       
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            return null; // Email déjà utilisé
        }

        // Insérer dans la base
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

   
    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        if ($row['role'] === 'acheteur') {
            return new Acheteur($row['id'], $row['nom'], $row['email'], $row['telephone'], $row['photo'], $row['password']);
        } 
        else{
            return new Organisateur($row['id'], $row['nom'], $row['email'], $row['telephone'], $row['photo'], $row['password']);
        }
    }
}
