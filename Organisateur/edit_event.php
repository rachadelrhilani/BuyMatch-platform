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


if (!$event || $event['organisateur_id'] != $organisateurId) {
    header('Location: my_events.php');
    exit;
}

$categories = $repo->getCategoriesByEvent($eventId);
$capacite = $categories[0]->getCapacite() ?? 0;


$date = date('Y-m-d', strtotime($event['date_event']));
$heure = date('H:i', strtotime($event['date_event']));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
    'titre' => $_POST['titre'],
    'date_event' => $_POST['date_event'] . ' ' . $_POST['heure_event'],
    'lieu' => $_POST['lieu'],
    'duree' => $_POST['duree'],
    'equipe1_nom' => $_POST['equipe1_nom'],
    'equipe2_nom' => $_POST['equipe2_nom'],
    'capacite' => $_POST['capacite'],
    'categories' => []
];

foreach ($_POST['categorie'] as $i => $nom) {
    $data['categories'][] = [
        'id' => $_POST['categorie_id'][$i],
        'nom' => $nom,
        'prix' => $_POST['prix'][$i]
    ];
}

$repo->updateEvent(
    $eventId,
    $organisateurId,
    $data,
    $_FILES
);
}


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

        <form method="POST" enctype="multipart/form-data" class="space-y-5">
            <input type="hidden" name="event_id" value="<?= $eventId ?>">

            
            <div>
                <label class="block font-medium mb-1">Titre</label>
                <input type="text" name="titre" required
                    value="<?= htmlspecialchars($event['titre']) ?>"
                    class="w-full border p-3 rounded">
            </div>

           
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

            
            <div class="grid grid-cols-2 gap-4">
                <input type="date" name="date_event" value="<?= $date ?>" required class="border p-3 rounded">
                <input type="time" name="heure_event" value="<?= $heure ?>" required class="border p-3 rounded">
            </div>

            
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="lieu" value="<?= htmlspecialchars($event['lieu']) ?>" required class="border p-3 rounded">
                <input type="number" name="duree" value="<?= $event['duree'] ?>" min="1" max="5" required class="border p-3 rounded">
            </div>

            
            <div>
                <label class="block font-medium mb-2">Catégories & prix</label>
                <div class="space-y-2">
                    <?php foreach ($categories as $cat): ?>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="categorie[]" value="<?= htmlspecialchars($cat->getNom()) ?>"
                                class="border p-2 rounded">
                            <input type="number" name="prix[]" value="<?= htmlspecialchars($cat->getPrix()) ?>"
                                class="border p-2 rounded">
                                <input type="hidden" name="categorie_id[]" value="<?= $cat->getId() ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            
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