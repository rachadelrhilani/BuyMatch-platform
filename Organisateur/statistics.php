<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
</head>
<body>
    <?php include '../includes/navbar_organisateur.php'; ?>

<div class="max-w-4xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white shadow p-6 rounded">
        <h3 class="text-gray-600">Billets vendus</h3>
        <p class="text-3xl font-bold text-blue-600"><?= $stats['billets_vendus'] ?></p>
    </div>

    <div class="bg-white shadow p-6 rounded">
        <h3 class="text-gray-600">Chiffre d'affaires</h3>
        <p class="text-3xl font-bold text-green-600"><?= $stats['chiffre_affaires'] ?> DH</p>
    </div>
</div>
</body>
</html>