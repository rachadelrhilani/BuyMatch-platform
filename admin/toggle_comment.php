<?php
$requiredRole = 'admin';
require_once '../includes/auth_check.php';
require_once '../repositories/AdminRepository.php';

$id = (int)$_GET['id'];
$status = $_GET['status'];

$repo = new AdminRepository();
$repo->updateCommentStatus($id, $status);

header("Location: dashboard.php");
exit;
