<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit;
}


if (isset($requiredRole)) {
    if ($_SESSION['user']['role'] !== $requiredRole) {
        header("Location: ../public/login.php");
        exit;
    }
}
