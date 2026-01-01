<?php
$pageTitle = "Accueil - SportTicket";
include '../includes/header.php';
require_once '../repositories/EventRepository.php';

$events = EventRepository::getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl">
            <h1 class="text-5xl font-bold mb-6">Réservez vos billets pour les meilleurs événements sportifs</h1>
            <p class="text-xl mb-8">Découvrez et achetez vos billets pour les matchs de football, basketball, tennis et bien plus encore.</p>
            <a href="#events" class="inline-block px-8 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                Explorer les matchs <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>


<section class="bg-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="flex-1 min-w-[200px]">
                <input type="text" id="searchInput" placeholder="Rechercher un match..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="min-w-[180px]">
                <select id="locationFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Toutes les villes</option>
                    <option value="casablanca">Casablanca</option>
                    <option value="rabat">Rabat</option>
                    <option value="marrakech">Marrakech</option>
                    <option value="tanger">Tanger</option>
                </select>
            </div>
            <div class="min-w-[180px]">
                <select id="sportFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les sports</option>
                    <option value="football">Football</option>
                    <option value="basketball">Basketball</option>
                    <option value="tennis">Tennis</option>
                    <option value="volleyball">Volleyball</option>
                </select>
            </div>
            <button id="filterBtn" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-filter mr-2"></i>Filtrer
            </button>
        </div>
    </div>
</section>

<!-- Events Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8">Matchs à venir</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($events as $event): ?>
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition">

                    <div class="relative bg-gray-100 h-48 flex items-center justify-center">
                        <img src="<?= $event->getEquipeDomicile()->getLogo() ?>" class="w-20 mx-4">
                        <span class="text-3xl font-bold">VS</span>
                        <img src="<?= $event->getEquipeExterieure()->getLogo() ?>" class="w-20 mx-4">
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">
                            <?= $event->getEquipeDomicile()->getNom() ?>
                            vs
                            <?= $event->getEquipeExterieure()->getNom() ?>
                        </h3>

                        <p class="text-gray-600">
                            📍 <?= $event->getLieu() ?>
                        </p>
                        <p class="text-gray-600">
                            📅 <?= $event->getDate()->format('d/m/Y H:i') ?>
                        </p>

                        <div class="mt-4 flex justify-between items-center">
                            <a href="event_detail.php?id=<?= $event->getId() ?>"
                               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Détails
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- CTA Section -->
<section class="bg-blue-600 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Prêt à vivre l'expérience ?</h2>
        <p class="text-xl mb-8">Inscrivez-vous maintenant et ne manquez aucun événement sportif</p>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <a href="register.php" class="inline-block px-8 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                Créer un compte gratuitement
            </a>
        <?php endif; ?>
    </div>
</section>


<?php include '../includes/footer.php'; ?>
</body>
</html>