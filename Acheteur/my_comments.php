<?php
$requiredRole = 'acheteur';
require_once '../includes/auth_check.php';
require_once '../repositories/CommentRepository.php';

$commentRepo = new CommentRepository();
$comments = $commentRepo->getCommentairesByAcheteur($_SESSION['user']['id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes commentaires</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<?php require_once '../includes/navbar_Acheteur.php'; ?>

<div class="max-w-6xl mx-auto p-6 mt-10">
    <h2 class="text-3xl font-bold mb-6">Mes commentaires</h2>

    <?php if (empty($comments)): ?>
        <div class="bg-white p-6 rounded shadow text-gray-500">
            Vous n'avez encore laissé aucun commentaire.
        </div>
    <?php else: ?>

        <?php foreach ($comments as $c): ?>
            <div class="bg-white shadow rounded-xl p-5 mb-5">

                <!-- Match -->
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <img src="../uploads/teams/<?= htmlspecialchars($c['equipe1_logo']) ?>"
                             class="w-10 h-10 object-contain">
                        <span class="font-semibold"><?= htmlspecialchars($c['equipe1_nom']) ?></span>

                        <span class="font-bold text-gray-400">VS</span>

                        <span class="font-semibold"><?= htmlspecialchars($c['equipe2_nom']) ?></span>
                        <img src="../uploads/teams/<?= htmlspecialchars($c['equipe2_logo']) ?>"
                             class="w-10 h-10 object-contain">
                    </div>

                    <span class="text-sm text-gray-500">
                        <?= date('d/m/Y', strtotime($c['created_at'])) ?>
                    </span>
                </div>

                <!-- Event -->
                <h3 class="font-bold text-lg text-gray-800 mb-2">
                    <?= htmlspecialchars($c['event_titre']) ?>
                </h3>

                <!-- Comment -->
                <p class="text-gray-700 mb-2">
                    <?= nl2br(htmlspecialchars($c['contenu'])) ?>
                </p>

                <!-- Note -->
                <div class="text-yellow-500 font-semibold">
                    ⭐ <?= $c['note'] ?>/5
                </div>

            </div>
        <?php endforeach; ?>

    <?php endif; ?>
</div>

</body>
</html>
