<?php
$requiredRole = 'admin';
require_once '../includes/auth_check.php';
echo $_SESSION['user']['role'];
?>