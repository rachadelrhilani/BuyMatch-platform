<?php
$requiredRole = 'acheteur';
require_once '../includes/auth_check.php';
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
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

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <?php require_once '../includes/navbar_Acheteur.php'; ?>

    <div class="max-w-4xl mx-auto p-6 mt-10 mb-10">
        
        <!-- En-tête avec informations du match -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl shadow-xl p-8 mb-8 text-white">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Réservation de billets</h1>
                    <p class="text-blue-100">Complétez votre commande en quelques étapes</p>
                </div>
            </div>
            
            <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                <h2 class="text-xl font-bold mb-2"><?= htmlspecialchars($event->getTitre()) ?></h2>
                <div class="flex items-center gap-4 text-blue-100">

                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        <?= htmlspecialchars($event->getLieu()) ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Message d'erreur -->
        <?php if ($error): ?>
            <div class="mb-6 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 p-4 rounded-lg shadow-md">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-red-700 font-semibold"><?= htmlspecialchars($error) ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Formulaire de commande -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 border-b border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Détails de la réservation
                </h3>
            </div>

            <div class="p-8">
                <form method="POST" action="process_order.php" class="space-y-6">

                    <input type="hidden" name="event_id" value="<?= $eventId ?>">

                    <!-- Catégorie -->
                    <div>
                        <label class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Choisissez votre catégorie
                        </label>
                        <select name="categorie_id" required 
                            class="w-full border-2 border-gray-200 p-4 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition outline-none font-semibold text-gray-700">
                            <option value="">Sélectionnez une catégorie</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat->getId() ?>">
                                    <?= htmlspecialchars($cat->getNom()) ?> – <?= htmlspecialchars($cat->getPrix()) ?> DH
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Place -->
                    <div>
                        <label class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Numéro de place
                        </label>
                        <input type="text" name="place" required
                            class="w-full border-2 border-gray-200 p-4 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition outline-none font-semibold"
                            placeholder="Exemple: A12, B45, VIP10...">
                        <p class="text-sm text-gray-500 mt-2 ml-1">Indiquez le numéro de votre siège</p>
                    </div>

                    <!-- Quantité -->
                    <div>
                        <label class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Nombre de billets
                        </label>
                        <input type="number" name="quantite" min="1" max="4" required
                            class="w-full border-2 border-gray-200 p-4 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition outline-none font-bold text-lg"
                            placeholder="1">
                        <p class="text-sm text-gray-500 mt-2 ml-1">Maximum 4 billets par commande</p>
                    </div>

                    <!-- Informations supplémentaires -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">Informations importantes</p>
                                <ul class="list-disc list-inside space-y-1 text-blue-700">
                                    <li>Vérifiez bien votre catégorie et place avant de valider</li>
                                    <li>Vos billets seront envoyés par email après confirmation</li>
                                    <li>Présentez votre billet électronique à l'entrée du stade</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton de confirmation -->
                    <button class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-5 rounded-xl font-bold text-lg transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Confirmer l'achat
                    </button>
                </form>
            </div>
        </div>

        <!-- Sécurité -->
        <div class="mt-6 text-center">
            <div class="inline-flex items-center gap-2 text-gray-600 bg-white px-6 py-3 rounded-full shadow-md">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span class="font-semibold">Paiement 100% sécurisé</span>
            </div>
        </div>
    </div>

</body>

</html>