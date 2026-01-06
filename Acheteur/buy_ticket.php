<?php
$requiredRole = 'acheteur';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';

$eventId = (int)($_GET['event'] ?? 0);
$eventRepo = new EventRepository();
$event = $eventRepo->findById($eventId);
$categories = $eventRepo->getCategoriesByEvent($eventId);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Achat billet</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php require_once '../includes/navbar_Acheteur.php'; ?>

    <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded mt-10">
        <h2 class="text-2xl font-bold mb-4">
            Acheter un billet – <?= htmlspecialchars($event->getTitre()) ?>
        </h2>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded">
                <?= $_SESSION['error'] ?>
            </div>
        <?php unset($_SESSION['error']);
        endif; ?>


        <form method="POST" action="process_order.php" class="space-y-4">

            <input type="hidden" name="event_id" value="<?= $eventId ?>">

            <!-- Catégorie -->
            <div>
                <label class="font-semibold">Catégorie</label>
                <select name="categorie_id" required class="w-full border p-2 rounded">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat->getId() ?>">
                            <?= htmlspecialchars($cat->getNom()) ?> – <?= htmlspecialchars($cat->getPrix()) ?> DH
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Place -->
            <div>
                <label class="font-semibold">Numéro de place</label>
                <input type="text" name="place" required
                    class="w-full border p-2 rounded"
                    placeholder="Ex: A12">
            </div>

            <!-- Quantité -->
            <div>
                <label class="font-semibold">Nombre de billets</label>
                <input type="number" name="quantite" min="1" max="4" required
                    class="w-full border p-2 rounded">
            </div>

            <button class="w-full bg-blue-600 text-white py-3 rounded font-bold">
                Confirmer l’achat
            </button>
        </form>
    </div>

</body>

</html>