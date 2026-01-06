<?php
$requiredRole = 'admin';
require_once '../includes/auth_check.php';
require_once '../repositories/AdminRepository.php';

$repo = new AdminRepository();
$stats = $repo->getGlobalStats();
$comments = $repo->getReportedComments();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black-100">

<?php require_once '../includes/navbar_admin.php'; ?>

<div class="max-w-7xl mx-auto p-6">

    <!-- 📊 STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Utilisateurs</p>
            <p class="text-3xl font-bold text-blue-600"><?= $stats['users'] ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Événements</p>
            <p class="text-3xl font-bold text-purple-600"><?= $stats['events'] ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Billets vendus</p>
            <p class="text-3xl font-bold text-green-600"><?= $stats['tickets'] ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Chiffre d’affaires</p>
            <p class="text-3xl font-bold text-red-600">
                <?= number_format($stats['revenue'], 2) ?> DH
            </p>
        </div>
    </div>

    <!-- 🚨 COMMENTAIRES SIGNALÉS -->
    <h2 class="text-2xl font-bold mb-4">Commentaires signalés</h2>

    <?php if (empty($comments)): ?>
        <div class="bg-white p-6 rounded shadow text-gray-500">
            Aucun commentaire signalé.
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach ($comments as $c): ?>
                <div class="bg-white p-5 rounded shadow border-l-4 border-red-500">
                    <p class="font-semibold"><?= htmlspecialchars($c['event_titre']) ?></p>
                    <p class="text-gray-700 mt-1"><?= htmlspecialchars($c['contenu']) ?></p>

                    <div class="flex justify-between items-center mt-3 text-sm text-gray-500">
                        <span>
                            ⭐ <?= $c['note'] ?>/5 — <?= htmlspecialchars($c['user_nom']) ?>
                        </span>
                        <span><?= date('d/m/Y H:i', strtotime($c['created_at'])) ?></span>
                    </div>

                    <div class="mt-4">
                        <a href="toggle_comment.php?id=<?= $c['id'] ?>&status=visible"
                           class="bg-green-600 text-white px-3 py-1 rounded">
                            Afficher
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
