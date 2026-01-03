<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';

$organisateurId = $_SESSION['user']['id'];
$eventRepo = new EventRepository();
$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'titre' => trim($_POST['titre']),
        'equipe1_nom' => trim($_POST['equipe1_nom']),
        'equipe2_nom' => trim($_POST['equipe2_nom']),
        'date_event' => trim($_POST['date_event'] . ' ' . $_POST['heure_event']),
        'lieu' => trim($_POST['lieu']),
        'duree' => (int)$_POST['duree'],
        'categories' => []
    ];

    for ($i = 0; $i < 3; $i++) {
        if (!empty($_POST['categorie'][$i]) && !empty($_POST['prix'][$i])) {
            $data['categories'][] = [
                'nom' => trim($_POST['categorie'][$i]),
                'prix' => (float)$_POST['prix'][$i],
                'places' => (int)$_POST['places'] 
            ];
        }
    }


    $files = [
        'equipe1_logo' => $_FILES['equipe1_logo'],
        'equipe2_logo' => $_FILES['equipe2_logo']
    ];

    if ($eventRepo->createEvent($data, $files, $organisateurId)) {
        $success = "L'événement a été créé avec succès et est en attente de validation.";
    } else {
        $error = "Une erreur est survenue lors de la création de l'événement.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un événement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php require_once '../includes/navbar_organisateur.php'; ?> 

    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 shadow-lg rounded-xl">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Créer un événement sportif</h2>

        <?php if ($success): ?>
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded"><?= $success ?></div>
        <?php elseif ($error): ?>
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-5" enctype="multipart/form-data">

            <!-- Titre -->
            <div>
                <label class="block font-medium mb-1">Titre de l'événement</label>
                <input type="text" name="titre" required
                       class="w-full border p-3 rounded focus:ring focus:ring-blue-300">
            </div>

            <!-- Équipes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Équipe 1 -->
                <div class="border p-4 rounded-lg bg-gray-50">
                    <h3 class="font-semibold text-lg mb-3">Équipe Domicile</h3>
                    <label class="block mb-2">Nom de l'équipe</label>
                    <input type="text" name="equipe1_nom" required class="w-full border p-3 rounded mb-3">
                    <label class="block mb-2">Logo de l'équipe</label>
                    <input type="file" name="equipe1_logo" accept="image/*" class="w-full border p-2 rounded">
                </div>

                <!-- Équipe 2 -->
                <div class="border p-4 rounded-lg bg-gray-50">
                    <h3 class="font-semibold text-lg mb-3">Équipe Extérieure</h3>
                    <label class="block mb-2">Nom de l'équipe</label>
                    <input type="text" name="equipe2_nom" required class="w-full border p-3 rounded mb-3">
                    <label class="block mb-2">Logo de l'équipe</label>
                    <input type="file" name="equipe2_logo" accept="image/*" class="w-full border p-2 rounded">
                </div>
            </div>

            <!-- Date / Heure -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Date</label>
                    <input type="date" name="date_event" required class="w-full border p-3 rounded">
                </div>
                <div>
                    <label class="block font-medium mb-1">Heure</label>
                    <input type="time" name="heure_event" required class="w-full border p-3 rounded">
                </div>
            </div>

            <!-- Lieu + Durée -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Lieu</label>
                    <input type="text" name="lieu" required class="w-full border p-3 rounded">
                </div>
                <div>
                    <label class="block font-medium mb-1">Durée (en heures)</label>
                    <input type="number" name="duree" max="5" min="1" required class="w-full border p-3 rounded">
                </div>
            </div>

            <!-- Catégories & prix -->
            <div>
                <label class="block font-medium mb-2">Catégories & prix</label>
                <div class="grid grid-cols-3 gap-4">
                    <input type="text" name="categorie[]" placeholder="Catégorie 1" class="border p-2 rounded">
                    <input type="number" name="prix[]" placeholder="Prix" class="border p-2 rounded">

                    <input type="text" name="categorie[]" placeholder="Catégorie 2" class="border p-2 rounded">
                    <input type="number" name="prix[]" placeholder="Prix" class="border p-2 rounded">

                    <input type="text" name="categorie[]" placeholder="Catégorie 3" class="border p-2 rounded">
                    <input type="number" name="prix[]" placeholder="Prix" class="border p-2 rounded">
                </div>
            </div>

            <!-- Nombre de places -->
            <div>
                <label class="block font-medium mb-1">Nombre total de places</label>
                <input type="number" name="places" max="2000" required class="w-full border p-3 rounded">
            </div>

            <button class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded font-semibold">
                Créer l'événement
            </button>
        </form>
    </div>
</body>
</html>
