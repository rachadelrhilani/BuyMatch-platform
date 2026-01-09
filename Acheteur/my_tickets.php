<?php
$requiredRole = 'acheteur';
require_once '../includes/auth_check.php';

require_once '../repositories/OrderRepository.php';

$userId = $_SESSION['user']['id'];
$orderRepo = new OrderRepository();

$tickets = $orderRepo->getTicketsByAcheteur($userId);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes billets</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<?php require_once '../includes/navbar_Acheteur.php'; ?>

<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">🎟️ Mes billets</h2>

    <?php if (empty($tickets)): ?>
        <div class="bg-white p-6 rounded shadow text-gray-500">
            Aucun billet réservé pour le moment.
        </div>
    <?php else: ?>
        <div class="grid md:grid-cols-2 gap-6">
            <?php foreach ($tickets as $ticket): ?>
                <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-600">

                    <!-- Match -->
                    <h3 class="text-lg font-bold text-gray-800">
                        <?= htmlspecialchars($ticket['titre']) ?>
                    </h3>

                    <p class="text-sm text-gray-600 mb-2">
                        📍 <?= htmlspecialchars($ticket['lieu']) ?><br>
                        🗓️ <?= date('d/m/Y H:i', strtotime($ticket['date_event'])) ?>
                        <?= htmlspecialchars($ticket['prix']) ?><br>
                    </p>

                    <!-- Infos ticket -->
                    <div class="text-sm text-gray-700 space-y-1 mb-4">
                        <p><strong>Catégorie :</strong> <?= htmlspecialchars($ticket['categorie']) ?></p>
                        <p><strong>Place :</strong> <?= htmlspecialchars($ticket['place']) ?></p>
                        <p><strong>Numéro :</strong> <?= htmlspecialchars($ticket['numero']) ?></p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3">
                        <a href="download_ticket.php?ticket=<?= $ticket['id'] ?>"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold">
                            📄 PDF
                        </a>

                        <a href="send_ticket_email.php?ticket=<?= $ticket['id'] ?>"
                           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm font-semibold">
                            📧 Envoyer par email
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
