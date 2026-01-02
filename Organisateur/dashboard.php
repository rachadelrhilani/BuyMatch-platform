<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';
$repo = new EventRepository();
$stats = $repo->getStatsByOrganisateur($_SESSION['user']['id']);
$comments = $repo->getCommentairesByOrganisateur($_SESSION['user']['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-organisateur</title>
</head>
<body>
   <?php require_once '../includes/navbar_organisateur.php'; ?> 
   <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-gray-500">Billets vendus</h3>
        <p class="text-3xl font-bold text-blue-600"><?= $stats['billets_vendus'] ?? 0 ?></p>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-gray-500">Chiffre d'affaires</h3>
        <p class="text-3xl font-bold text-green-600"><?= number_format($stats['chiffre_affaires'] ?? 0, 2) ?> DH</p>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-gray-500">Événements actifs</h3>
        <p class="text-3xl font-bold text-purple-600">5</p>
    </div>
</div>
<!-- Commentaires -->
<div class="max-w-4xl mx-auto px-8 pb-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        Commentaires récents
    </h2>

    <?php if (empty($comments)): ?>
        <div class="bg-white p-6 rounded shadow text-gray-500">
            Aucun commentaire pour le moment.
        </div>
    <?php else: ?>
        <?php foreach ($comments as $comment): ?>
    <div class="bg-white shadow p-4 rounded mb-4">
        <p><?= htmlspecialchars($comment->getContenu()) ?></p>
        <span class="text-sm text-gray-500">
            Note : <?= $comment->getNote() ?>/5
        </span>
    </div>
<?php endforeach; ?>

    <?php endif; ?>
</div>
</body>
</html>