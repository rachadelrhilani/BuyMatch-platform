<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';

$organisateurId = $_SESSION['user']['id'];
$eventRepo = new EventRepository();

// Récupérer tous les événements de l'organisateur
$events = $eventRepo->getByOrganisateur($organisateurId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes événements</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <?php include '../includes/navbar_organisateur.php'; ?>

    <div class="max-w-5xl mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Mes événements</h2>

        <?php if (empty($events)): ?>
            <p class="text-gray-600">Vous n'avez encore créé aucun événement.</p>
        <?php else: ?>
            <div class="overflow-x-auto bg-white shadow rounded">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 font-medium text-gray-700">Titre</th>
                            <th class="p-3 font-medium text-gray-700">Date</th>
                            <th class="p-3 font-medium text-gray-700">Statut</th>
                            <th class="p-3 font-medium text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3"><?= htmlspecialchars($event->getTitre()) ?></td>
                                <td class="p-3"><?= $event->getDate()->format('d/m/Y H:i') ?></td>
                                <td class="p-3">
                                    <?php if($event->getStatut() === 'valide'): ?>
                                        <span class="px-2 py-1 rounded bg-green-100 text-green-700 font-semibold"><?= $event->getStatut() ?></span>
                                    <?php elseif($event->getStatut() === 'en_attente'): ?>
                                        <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-semibold"><?= $event->getStatut() ?></span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 rounded bg-red-100 text-red-700 font-semibold"><?= $event->getStatut() ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-3 space-x-2">
                                    <a href="edit_event.php?id=<?= $event->getId() ?>" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Modifier</a>
                                    <a href="delete_event.php?id=<?= $event->getId() ?>" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
