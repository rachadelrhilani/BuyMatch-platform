<?php
session_start();
require_once '../repositories/UserRepository.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

$userRepo = new UserRepository();
$user = $userRepo->login($email, $password);

if (!$user) {
    $_SESSION['error'] = "Email ou mot de passe incorrect";
    header("Location: login.php");
    exit;
}


$_SESSION['user'] = [
    'id' => $user->getId(),
    'nom' => $user->getNom(),
    'email' => $user->getEmail(),
    'photo' => $user->getPhoto(),
    'role' => strtolower((new ReflectionClass($user))->getShortName())
];


switch ($_SESSION['user']['role']) {
    case 'admin':
        header("Location: ../admin/dashboard.php");
        break;

    case 'organisateur':
        header("Location: ../organisateur/dashboard.php");
        break;

    case 'acheteur':
        header("Location: ../acheteur/dashboard.php");
        break;
}

exit;
