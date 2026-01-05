<?php
$requiredRole = 'acheteur';
require_once '../includes/auth_check.php';
require_once '../repositories/CommentRepository.php';

$repo = new CommentRepository();

$repo->addComment(
    $_SESSION['user']['id'],
    $_POST['event_id'],
    $_POST['contenu'],
    (int) $_POST['note']
);

header('Location: dashboard.php');
exit;
