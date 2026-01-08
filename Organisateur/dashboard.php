<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';
require_once '../repositories/CommentRepository.php';
$repoevent = new EventRepository();
$repocomment = new CommentRepository;
$stats = $repoevent->getStatsByOrganisateur($_SESSION['user']['id']);
$activeEvents = $repoevent->countActiveEvents();
$commentaires = $repocomment->getCommentairesByOrganisateur($_SESSION['user']['id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-organisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

   <?php require_once '../includes/navbar_organisateur.php'; ?> 

   <div class="max-w-7xl mx-auto p-6">
    <!-- Section Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-6">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Billets vendus</h3>
            <p class="text-4xl font-extrabold text-blue-600 mt-2"><?= htmlspecialchars($stats['billets_vendus'] ?? 0) ?></p>
        </div>

        <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-6">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Chiffre d'affaires</h3>
            <p class="text-4xl font-extrabold text-green-600 mt-2"><?= htmlspecialchars(number_format($stats['chiffre_affaires'] ?? 0, 2)) ?> <span class="text-lg font-normal">DH</span></p>
        </div>

        <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-6">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Événements actifs</h3>
            <p class="text-4xl font-extrabold text-purple-600 mt-2"><?= htmlspecialchars($activeEvents) ?></p>
        </div>
    </div>

    <!-- Section Commentaires -->
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Commentaires clients</h2>

    <div class="space-y-4">
    <?php if (empty($commentaires)): ?>
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-gray-500 text-center">
            Aucun commentaire pour le moment.
        </div>
    <?php else: ?>
        <?php foreach ($commentaires as $comment): ?>
            <div class="bg-white shadow-sm p-6 rounded-xl border-l-8 border-blue-500 hover:shadow-md transition-shadow">
                
                <h3 class="font-bold text-xl text-gray-900 mb-2">
                    <?= htmlspecialchars($comment->getEventTitre()) ?>
                </h3>

                <p class="text-gray-600 mb-4 leading-relaxed italic">
                    "<?= htmlspecialchars($comment->getContenu()) ?>"
                </p>

                <div class="flex justify-between items-center text-sm font-medium">
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                        ⭐ <?= htmlspecialchars($comment->getNote()) ?> / 5
                    </span>
                    <span class="text-gray-400">
                        Posté le <?= date('d/m/Y H:i', strtotime($comment->getCreatedAt())) ?>
                    </span>
                </div>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
   </div>

</body>
</html>
