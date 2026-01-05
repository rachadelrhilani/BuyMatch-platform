<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
require_once '../repositories/UserRepository.php';

$repo = new UserRepository();
$userId = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $success = $repo->updateProfile($userId, $_POST, $_FILES);

    if ($success) {
        // mettre à jour la session
        $_SESSION['user']['nom'] = $_POST['nom'];
        $_SESSION['user']['email'] = $_POST['email'];
        $_SESSION['user']['telephone'] = $_POST['telephone'];

        header('Location: profile.php?success=1');
    } else {
        header('Location: profile.php?error=1');
    }
    exit;
}
