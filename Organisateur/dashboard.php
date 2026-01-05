<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';
$repo = new EventRepository();
$stats = $repo->getStatsByOrganisateur($_SESSION['user']['id']);
$commentaires = $repo->getCommentairesByOrganisateur($_SESSION['user']['id']);
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
<?php if (empty($commentaires)): ?>
    <div class="bg-white p-6 rounded shadow text-gray-500">
        Aucun commentaire pour le moment.
    </div>
<?php else: ?>
    <?php foreach ($commentaires as $comment): ?>
        <div class="bg-white shadow p-5 rounded mb-4 border-l-4 border-blue-600">

           
            <h3 class="font-semibold text-lg text-gray-800 mb-1">
                <?= htmlspecialchars($comment->getEventTitre()) ?>
            </h3>

           
            <p class="text-gray-700 mb-2">
                <?= htmlspecialchars($comment->getContenu()) ?>
            </p>

           
            <div class="flex justify-between text-sm text-gray-500">
                <span>⭐ <?= $comment->getNote() ?>/5</span>
                <span><?= date('d/m/Y H:i', strtotime($comment->getCreatedAt())) ?></span>
            </div>

        </div>
    <?php endforeach; ?>
<?php endif; ?>

</div>
</body>
</html>