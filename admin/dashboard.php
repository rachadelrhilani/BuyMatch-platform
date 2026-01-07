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

<body class="bg-gray-950 text-gray-200 min-h-screen">

<?php require_once '../includes/navbar_admin.php'; ?>

<div class="max-w-7xl mx-auto p-6">

    <!-- 📊 STATISTIQUES -->
    <h1 class="text-3xl font-bold mb-8">📊 Dashboard Administrateur</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <div class="bg-gray-900 p-6 rounded-xl shadow border border-gray-800">
            <p class="text-gray-400">Utilisateurs</p>
            <p class="text-4xl font-bold text-blue-400"><?= $stats['users'] ?></p>
        </div>

        <div class="bg-gray-900 p-6 rounded-xl shadow border border-gray-800">
            <p class="text-gray-400">Événements</p>
            <p class="text-4xl font-bold text-purple-400"><?= $stats['events'] ?></p>
        </div>

        <div class="bg-gray-900 p-6 rounded-xl shadow border border-gray-800">
            <p class="text-gray-400">Billets vendus</p>
            <p class="text-4xl font-bold text-green-400"><?= $stats['tickets'] ?></p>
        </div>

        <div class="bg-gray-900 p-6 rounded-xl shadow border border-gray-800">
            <p class="text-gray-400">Chiffre d’affaires</p>
            <p class="text-4xl font-bold text-red-400">
                <?= number_format($stats['revenue'], 2) ?> DH
            </p>
        </div>
    </div>

    <!-- 🚨 COMMENTAIRES SIGNALÉS -->
    <h2 class="text-2xl font-bold mb-6">🚨 Commentaires signalés</h2>

    <?php if (empty($comments)): ?>
        <div class="bg-gray-900 p-6 rounded-xl border border-gray-800 text-gray-400">
            Aucun commentaire signalé.
        </div>
    <?php else: ?>
        <div class="space-y-5">
            <?php foreach ($comments as $c): ?>
                <div class="bg-gray-900 p-6 rounded-xl shadow border border-red-800/40">

                    <p class="text-lg font-semibold text-white">
                        <?= htmlspecialchars($c['event_titre']) ?>
                    </p>
                    

                    <p class="text-gray-300 mt-2">
                        <?= htmlspecialchars($c['contenu']) ?>
                    </p>
                    
                    <p class="text-gray-400 mt-2">
                       Statut : <?= htmlspecialchars($c['statut']) ?>
                    </p>
                    <div class="flex justify-between items-center mt-4 text-sm text-gray-400">
                        <span>
                            ⭐ <?= $c['note'] ?>/5 — <?= htmlspecialchars($c['user_nom']) ?>
                        </span>
                        <span>
                            <?= date('d/m/Y H:i', strtotime($c['created_at'])) ?>
                        </span>
                    </div>

                    <div class="mt-5">
                        <a href="toggle_comment.php?id=<?= $c['id'] ?>&status=visible"
                           class="inline-block bg-green-600 hover:bg-green-700 transition text-white px-4 py-2 rounded-lg text-sm">
                            ✔ Afficher le commentaire
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
