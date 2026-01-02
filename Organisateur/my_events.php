<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos evenements</title>
</head>
<body>
    <?php include '../includes/navbar_organisateur.php'; ?>

<div class="p-8">
    <h2 class="text-2xl font-bold mb-6">Mes événements</h2>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Titre</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr class="border-t">
                <td class="p-3"><?= $event->getTitre() ?></td>
                <td><?= $event->getDate()->format('d/m/Y') ?></td>
                <td class="text-blue-600"><?= $event->getStatut() ?></td>
                <td>
                    <a href="edit_event.php?id=<?= $event->getId() ?>" class="text-indigo-600">
                        Modifier
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>