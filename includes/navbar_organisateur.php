<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'organisateur') {
    header('Location: ../login.php');
    exit;
}
$avatar = !empty($_SESSION['user']['photo']) ? "../uploads/avatars/" . $_SESSION['user']['photo'] : "../uploads/avatars/default.png";
?>

<nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">

            
            <a href="dashboard.php" class="flex items-center space-x-3 group">
                <div class="bg-blue-600 p-2 rounded-lg group-hover:bg-blue-700 transition">
                    <i class="fas fa-ticket-alt text-white text-xl"></i>
                </div>
                <span class="text-2xl font-black tracking-tight text-gray-900 uppercase">Buy<span class="text-blue-600">Match</span></span>
            </a>

            
            <div class="hidden lg:flex items-center space-x-1">
                <a href="dashboard.php" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition duration-200">
                    <i class="fas fa-chart-line mr-2"></i>Dashboard
                </a>
                <a href="create_event.php" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition duration-200">
                    <i class="fas fa-plus-circle mr-2"></i>Créer
                </a>
                <a href="my_events.php" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition duration-200">
                    <i class="fas fa-calendar-check mr-2"></i>Mes Matchs
                </a>
                <a href="profile.php" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition duration-200">
                    <i class="fas fa-poll mr-2"></i>Profile
                </a>
            </div>

            
            <div class="hidden md:flex items-center space-x-6">
                <div class="flex items-center space-x-3 border-l pl-6 border-gray-100">
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-900 leading-tight"><?= htmlspecialchars($_SESSION['user']['nom']) ?></p>
                        <p class="text-xs text-blue-600 font-medium"><?= htmlspecialchars($_SESSION['user']['role']) ?></p>
                    </div>
                    <img src="<?= htmlspecialchars($avatar) ?>" class="w-10 h-10 rounded-full border-2 border-blue-100 object-cover" alt="Profile">
                </div>

                <a href="../public/logout.php"
                   class="flex items-center space-x-2 px-4 py-2 text-sm font-bold text-white bg-gray-900 rounded-xl hover:bg-red-600 transition-all duration-300 shadow-lg shadow-gray-200">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </div>

            <!-- Mobile Button -->
            <button id="mobileMenuBtn" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Menu Mobile Amélioré -->
        <div id="mobileMenu" class="hidden lg:hidden animate-fade-in-down pb-6">
            <div class="flex flex-col space-y-2 mt-2 pt-4 border-t border-gray-100">
                <a href="dashboard.php" class="flex items-center px-4 py-3 text-gray-700 bg-gray-50 rounded-xl font-bold"><i class="fas fa-chart-line w-8"></i>Dashboard</a>
                <a href="create_event.php" class="flex items-center px-4 py-3 text-gray-600 font-semibold"><i class="fas fa-plus-circle w-8 text-blue-600"></i>Créer un événement</a>
                <a href="my_events.php" class="flex items-center px-4 py-3 text-gray-600 font-semibold"><i class="fas fa-calendar-check w-8 text-blue-600"></i>Mes événements</a>
                <a href="profile.php" class="flex items-center px-4 py-3 text-gray-600 font-semibold"><i class="fas fa-poll w-8 text-blue-600"></i>Profile</a>
                <div class="h-px bg-gray-100 my-2"></div>
                <a href="../public/logout.php" class="flex items-center px-4 py-3 text-red-600 font-bold"><i class="fas fa-sign-out-alt w-8"></i>Déconnexion</a>
            </div>
        </div>
    </div>
</nav>

<style>
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down {
        animation: fade-in-down 0.3s ease-out;
    }
</style>

<script>
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
<script src="https://cdn.tailwindcss.com"></script>
