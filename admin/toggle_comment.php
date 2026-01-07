<?php
$requiredRole = 'admin';
require_once '../includes/auth_check.php';
require_once '../repositories/CommentRepository.php';

$id = (int)$_GET['id'];
$status = $_GET['status'];

$repo = new CommentRepository();
$repo->updateCommentStatus($id, $status);

header("Location: dashboard.php");
exit;
