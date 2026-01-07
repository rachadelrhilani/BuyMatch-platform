<?php
$requiredRole = 'admin';
require_once '../includes/auth_check.php';
require_once '../repositories/AdminRepository.php';

if (!isset($_GET['id'])) {
    header('Location: users.php');
    exit;
}

$repo = new AdminRepository();
$repo->toggleUserStatus((int)$_GET['id']);

header('Location: users.php');
exit;
