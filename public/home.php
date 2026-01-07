<?php
$pageTitle = "Accueil - SportTicket";
include '../includes/header.php';
require_once '../repositories/EventRepository.php';
$search = $_GET['search'] ?? null;
$lieu   = $_GET['lieu'] ?? null;

$eventrep = new EventRepository();
$events = $eventrep->filter($search,$lieu);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<section class="relative h-[80vh] flex items-center overflow-hidden bg-gray-500 text-white">
    <!-- Arrière-plan terrain avec Overlay dynamique -->
    <div class="absolute inset-0 z-0">
        <!-- Remplacez par votre propre image de terrain -->
        <img src="https://plus.unsplash.com/premium_photo-1684713510655-e6e31536168d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8dGVycmFpbiUyMGRlJTIwZm9vdGJhbGx8ZW58MHx8MHx8fDA%3D" 
             alt="Terrain de football moderne" 
             class="w-full h-full object-cover opacity-60">
        <!-- Dégradé pour le design moderne et la lisibilité -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-transparent"></div>
    </div>

    <!-- Contenu Principal -->
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">
                Réservez vos billets pour les <span class="text-blue-400">meilleurs matchs</span>
            </h1>
            <p class="text-xl mb-10 text-gray-200 max-w-lg border-l-4 border-blue-500 pl-4">
                Vivez l'adrénaline du stade. Découvrez et achetez vos billets pour les rencontres de football.
            </p>
            
            <a href="#events" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 rounded-lg font-bold shadow-lg shadow-blue-500/30 hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                Explorer les matchs 
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>


<!-- Search & Filter Section -->
<section id="events" class="py-8 bg-white shadow-sm">
    <div class="container mx-auto px-4">
        <form method="GET" class="flex flex-col md:flex-row gap-4 items-center bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
            <div class="flex-1 w-full">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Rechercher un match (équipe, titre...)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="<?= htmlspecialchars($search ?? '') ?>"
                >
            </div>

            <div class="w-full md:w-64">
                <select name="lieu" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Toutes les villes</option>
                    <option value="casablanca" <?= ($lieu === 'casablanca') ? 'selected' : '' ?>>Casablanca</option>
                    <option value="rabat" <?= ($lieu === 'rabat') ? 'selected' : '' ?>>Rabat</option>
                    <option value="marrakech" <?= ($lieu === 'marrakech') ? 'selected' : '' ?>>Marrakech</option>
                </select>
            </div>

            <button type="submit" class="w-full md:w-auto px-8 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">
                <i class="fas fa-search mr-2"></i> Filtrer
            </button>
        </form>
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
                        <img src="../uploads/teams/<?= htmlspecialchars($event->getEquipeDomicile()->getLogo()) ?>" class="w-20 mx-4">
                        <span class="text-3xl font-bold">VS</span>
                        <img src="../uploads/teams/<?= htmlspecialchars($event->getEquipeExterieure()->getLogo()) ?>" class="w-20 mx-4">
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">
                            <?= $event->getEquipeDomicile()->getNom() ?>
                            vs
                            <?= $event->getEquipeExterieure()->getNom() ?>
                        </h3>


                        <div class="mt-4 flex justify-between items-center">
                            <a href="event_details.php?id=<?= $event->getId() ?>"
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