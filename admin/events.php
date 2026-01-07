<?php
$requiredRole = 'admin';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';

$repo = new EventRepository();
$events = $repo->getEventsEnAttente();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demandes de matchs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white">

<?php require_once '../includes/navbar_admin.php'; ?>

<div class="max-w-6xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-8">📩 Demandes de matchs</h1>

    <?php if (empty($events)): ?>
        <div class="bg-gray-800 p-6 rounded-lg text-gray-400">
            Aucune demande en attente.
        </div>
    <?php else: ?>
        <div class="space-y-5">
            <?php foreach ($events as $e): ?>
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 shadow">

                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-semibold">
                                <?= htmlspecialchars($e['titre']) ?>
                            </h2>

                            <p class="text-gray-400 text-sm mt-1">
                                📍 <?= htmlspecialchars($e['lieu']) ?> |
                                📅 <?= date('d/m/Y', strtotime($e['date_event'])) ?>
                            </p>

                            <p class="text-gray-500 text-sm mt-1">
                                Organisateur : <?= htmlspecialchars($e['organisateur']) ?>
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <a href="event_action.php?id=<?= $e['id'] ?>&statut=valide"
                               class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg">
                                ✅ Valider
                            </a>

                            <a href="event_action.php?id=<?= $e['id'] ?>&statut=refuse"
                               class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg">
                                ❌ Refuser
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
