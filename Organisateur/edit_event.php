<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';

$repo = new EventRepository();

if (!isset($_GET['id'])) {
    header('Location: my_events.php');
    exit;
}

$eventId = (int) $_GET['id'];
$organisateurId = $_SESSION['user']['id'];

$event = $repo->getEventById($eventId);

// sécurité : event inexistant ou pas propriétaire
if (!$event || $event['organisateur_id'] != $organisateurId) {
    header('Location: my_events.php');
    exit;
}

$categories = $repo->getCategoriesByEvent($eventId);
$capacite = $categories[0]->getCapacite() ?? 0;
// séparer date / heure
$date = date('Y-m-d', strtotime($event['date_event']));
$heure = date('H:i', strtotime($event['date_event']));
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier événement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <?php include '../includes/navbar_organisateur.php'; ?>

    <div class="max-w-4xl mx-auto p-8 bg-white shadow rounded mt-8">
        <h2 class="text-2xl font-bold mb-6">Modifier l'événement</h2>

        <form method="POST" action="update_event.php" enctype="multipart/form-data" class="space-y-5">
            <input type="hidden" name="event_id" value="<?= $eventId ?>">

            <!-- Titre -->
            <div>
                <label class="block font-medium mb-1">Titre</label>
                <input type="text" name="titre" required
                    value="<?= htmlspecialchars($event['titre']) ?>"
                    class="w-full border p-3 rounded">
            </div>

            <!-- Équipes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="border p-4 rounded bg-gray-50">
                    <h3 class="font-semibold mb-3">Équipe Domicile</h3>
                    <input type="text" name="equipe1_nom"
                        value="<?= htmlspecialchars($event['equipe1_nom']) ?>"
                        class="w-full border p-3 rounded mb-3">
                    <input type="file" name="equipe1_logo" accept="image/*">
                    <p class="text-sm text-gray-500 mt-1">Laisser vide pour conserver le logo</p>
                </div>

                <div class="border p-4 rounded bg-gray-50">
                    <h3 class="font-semibold mb-3">Équipe Extérieure</h3>
                    <input type="text" name="equipe2_nom"
                        value="<?= htmlspecialchars($event['equipe2_nom']) ?>"
                        class="w-full border p-3 rounded mb-3">
                    <input type="file" name="equipe2_logo" accept="image/*">
                    <p class="text-sm text-gray-500 mt-1">Laisser vide pour conserver le logo</p>
                </div>

            </div>

            <!-- Date / Heure -->
            <div class="grid grid-cols-2 gap-4">
                <input type="date" name="date_event" value="<?= $date ?>" required class="border p-3 rounded">
                <input type="time" name="heure_event" value="<?= $heure ?>" required class="border p-3 rounded">
            </div>

            <!-- Lieu / Durée -->
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="lieu" value="<?= htmlspecialchars($event['lieu']) ?>" required class="border p-3 rounded">
                <input type="number" name="duree" value="<?= $event['duree'] ?>" min="1" max="5" required class="border p-3 rounded">
            </div>

            <!-- Catégories -->
            <div>
                <label class="block font-medium mb-2">Catégories & prix</label>
                <div class="space-y-2">
                    <?php foreach ($categories as $cat): ?>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="categorie[]" value="<?= htmlspecialchars($cat->getNom()) ?>"
                                class="border p-2 rounded">
                            <input type="number" name="prix[]" value="<?= $cat->getPrix() ?>"
                                class="border p-2 rounded">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Places -->
            <div>
                <label class="block font-medium mb-1">Capacité (par catégorie)</label>
                <input type="number"
                    name="capacite"
                    value="<?= $capacite ?>"
                    min="1"
                    max="2000"
                    required
                    class="w-full border p-3 rounded">
                <p class="text-sm text-gray-500 mt-1">
                    La capacité sera appliquée à toutes les catégories
                </p>
            </div>

            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded font-semibold">
                Enregistrer les modifications
            </button>
        </form>
    </div>

</body>

</html>