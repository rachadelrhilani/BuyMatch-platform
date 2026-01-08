<?php
$pageTitle = "Accueil - SportTicket";
include '../includes/header.php';
require_once '../repositories/EventRepository.php';
$search = $_GET['search'] ?? null;
$lieu   = $_GET['lieu'] ?? null;

$eventrep = new EventRepository();
$events = $eventrep->filter($search);
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
    <div class="absolute inset-0 z-0">
        <img src="https://plus.unsplash.com/premium_photo-1684713510655-e6e31536168d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8dGVycmFpbiUyMGRlJTIwZm9vdGJhbGx8ZW58MHx8MHx8fDA%3D" 
             alt="Terrain de football moderne" 
             class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-transparent"></div>
    </div>

    
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



<section class="py-16 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">À propos de buymatch</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Votre passion, notre mission</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Buymatch est la plateforme de référence pour réserver vos billets de matchs de football. 
                        Nous connectons les passionnés de sport aux plus grands événements sportifs du moment.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Depuis notre création, nous avons pour objectif de rendre l'accès aux stades simple, rapide et sécurisé. 
                        Que vous soyez un supporter assidu ou un amateur occasionnel, nous vous offrons une expérience de réservation fluide.
                    </p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <img src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=600&auto=format&fit=crop&q=60" 
                         alt="Équipe sportive" 
                         class="rounded-lg w-full h-64 object-cover">
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Réservation sécurisée</h4>
                    <p class="text-gray-600">Paiement 100% sécurisé et billets électroniques instantanés</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Service rapide</h4>
                    <p class="text-gray-600">Réservez en quelques clics et recevez vos billets immédiatement</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Support 24/7</h4>
                    <p class="text-gray-600">Une équipe dédiée pour répondre à toutes vos questions</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="events" class="py-12 bg-gradient-to-br from-blue-50 via-white to-blue-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Trouvez votre match</h2>
                <p class="text-gray-600">Recherchez parmi tous les événements disponibles</p>
            </div>
            
            <form method="GET" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 backdrop-blur-sm">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="flex-1 w-full relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Rechercher un match (équipe, compétition, stade...)"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition outline-none"
                            value="<?= htmlspecialchars($search ?? '') ?>"
                        >
                    </div>

                    <button type="submit" class="w-full md:w-auto px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-blue-800 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>



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