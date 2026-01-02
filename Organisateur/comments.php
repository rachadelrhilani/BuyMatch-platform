<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
</head>
<body>
    <?php include '../includes/navbar_organisateur.php'; ?>

<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Commentaires</h2>

    <?php foreach ($comments as $c): ?>
        <div class="bg-white shadow p-4 rounded mb-4">
            <p class="font-semibold"><?= $c['nom'] ?></p>
            <p class="text-gray-600"><?= $c['contenu'] ?></p>
            <span class="text-sm text-gray-400"><?= $c['created_at'] ?></span>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>