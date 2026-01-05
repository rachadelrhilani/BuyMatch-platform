<?php
$requiredRole = 'acheteur';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';
require_once '../repositories/CommentRepository.php';

$eventRepo = new EventRepository();
$commentRepo = new CommentRepository();

$availableEvents = $eventRepo->getAvailableEvents();
$finishedEvents  = $eventRepo->getFinishedEvents();
$userId = $_SESSION['user']['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-Acheteur</title>
</head>
<body>
    <?php require_once '../includes/navbar_Acheteur.php'; ?> 
    <div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Matchs disponibles</h2>

    <div class="grid md:grid-cols-2 gap-6">
        <?php foreach ($availableEvents as $event): ?>
            <div class="bg-white shadow rounded p-4">
                <h3 class="font-bold text-lg">
                    <?= htmlspecialchars($event['titre']) ?>
                </h3>
                <p class="text-gray-600">
                    <?= date('d/m/Y H:i', strtotime($event['date_event'])) ?> – <?= htmlspecialchars($event['lieu']) ?>
                </p>

                <a href="buy_ticket.php?event=<?= $event['id'] ?>"
                   class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded">
                    Acheter un billet
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="max-w-6xl mx-auto p-6 mt-10">
    <h2 class="text-2xl font-bold mb-4">Matchs terminés</h2>
     <?php if (empty($finishedEvents)){echo "rfr";} ?>
    <?php foreach ($finishedEvents as $event): ?>
        <div class="bg-white shadow rounded p-4 mb-4">
            <h3 class="font-semibold"><?= htmlspecialchars($event['titre']) ?></h3>

            <?php if (!$commentRepo->hasUserCommented($userId, $event['id'])): ?>
                <form method="POST" action="add_comment.php" class="mt-3 space-y-2">
                    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">

                    <textarea name="contenu" required
                        class="w-full border rounded p-2"
                        placeholder="Votre commentaire..."></textarea>

                    <select name="note" required class="border p-2 rounded">
                        <option value="">Note</option>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?>/5</option>
                        <?php endfor; ?>
                    </select>

                    <button class="bg-green-600 text-white px-4 py-2 rounded">
                        Envoyer
                    </button>
                </form>
            <?php else: ?>
                <p class="text-green-600 font-semibold mt-2">
                    ✔ Vous avez déjà commenté ce match
                </p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>