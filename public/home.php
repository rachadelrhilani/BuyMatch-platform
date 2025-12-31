<?php
session_start();
$pageTitle = "Accueil - SportTicket";
include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<!-- Hero Section -->
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

<!-- Filter Section -->
<section class="bg-white py-8 shadow-md">
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
<section id="events" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Matchs à venir</h2>
        
        <div id="eventsList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Event Card 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition event-card" data-location="casablanca" data-sport="football">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=500" alt="Match" class="w-full h-48 object-cover">
                    <span class="absolute top-4 right-4 px-3 py-1 bg-blue-600 text-white rounded-full text-sm font-semibold">Football</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Raja vs WAC</h3>
                    <div class="space-y-2 text-gray-600 mb-4">
                        <p><i class="fas fa-calendar-alt mr-2 text-blue-600"></i>15 Janvier 2025</p>
                        <p><i class="fas fa-clock mr-2 text-blue-600"></i>20:00</p>
                        <p><i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Stade Mohammed V, Casablanca</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-blue-600">200 DH</span>
                        <a href="event_detail.php?id=1" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Détails</a>
                    </div>
                </div>
            </div>

            <!-- Event Card 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition event-card" data-location="rabat" data-sport="basketball">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?w=500" alt="Match" class="w-full h-48 object-cover">
                    <span class="absolute top-4 right-4 px-3 py-1 bg-orange-600 text-white rounded-full text-sm font-semibold">Basketball</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">FUS Rabat vs AS Salé</h3>
                    <div class="space-y-2 text-gray-600 mb-4">
                        <p><i class="fas fa-calendar-alt mr-2 text-blue-600"></i>18 Janvier 2025</p>
                        <p><i class="fas fa-clock mr-2 text-blue-600"></i>19:00</p>
                        <p><i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Complexe Moulay Abdellah, Rabat</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-blue-600">150 DH</span>
                        <a href="event_detail.php?id=2" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Détails</a>
                    </div>
                </div>
            </div>

            <!-- Event Card 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition event-card" data-location="marrakech" data-sport="tennis">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1554068865-24cecd4e34b8?w=500" alt="Match" class="w-full h-48 object-cover">
                    <span class="absolute top-4 right-4 px-3 py-1 bg-green-600 text-white rounded-full text-sm font-semibold">Tennis</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tournoi International de Tennis</h3>
                    <div class="space-y-2 text-gray-600 mb-4">
                        <p><i class="fas fa-calendar-alt mr-2 text-blue-600"></i>22 Janvier 2025</p>
                        <p><i class="fas fa-clock mr-2 text-blue-600"></i>14:00</p>
                        <p><i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Royal Tennis Club, Marrakech</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-blue-600">300 DH</span>
                        <a href="event_detail.php?id=3" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Détails</a>
                    </div>
                </div>
            </div>
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

<script>
    // Filter functionality
    const filterBtn = document.getElementById('filterBtn');
    const searchInput = document.getElementById('searchInput');
    const locationFilter = document.getElementById('locationFilter');
    const sportFilter = document.getElementById('sportFilter');
    const eventCards = document.querySelectorAll('.event-card');

    function filterEvents() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedLocation = locationFilter.value.toLowerCase();
        const selectedSport = sportFilter.value.toLowerCase();

        eventCards.forEach(card => {
            const cardText = card.textContent.toLowerCase();
            const cardLocation = card.dataset.location;
            const cardSport = card.dataset.sport;

            const matchesSearch = cardText.includes(searchTerm);
            const matchesLocation = !selectedLocation || cardLocation === selectedLocation;
            const matchesSport = !selectedSport || cardSport === selectedSport;

            if (matchesSearch && matchesLocation && matchesSport) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    filterBtn.addEventListener('click', filterEvents);
    searchInput.addEventListener('keyup', (e) => {
        if (e.key === 'Enter') filterEvents();
    });
</script>

<?php include '../includes/footer.php'; ?>
</body>
</html>