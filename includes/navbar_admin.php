<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../public/login.php');
    exit;
}
?>

<nav class="bg-gray-900 text-white sticky top-0 z-50 shadow">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="dashboard.php" class="flex items-center space-x-3">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <i class="fas fa-shield-alt text-white text-xl"></i>
                </div>
                <span class="text-2xl font-black uppercase tracking-wide">
                    Buy<span class="text-blue-500">Match</span> Admin
                </span>
            </a>

            <!-- Menu Desktop -->
            <div class="hidden lg:flex items-center space-x-2">
                <a href="dashboard.php" class="nav-admin-link">
                    <i class="fas fa-chart-bar mr-2"></i>Dashboard
                </a>
                <a href="users.php" class="nav-admin-link">
                    <i class="fas fa-users mr-2"></i>Utilisateurs
                </a>
                <a href="events.php" class="nav-admin-link">
                    <i class="fas fa-check-circle mr-2"></i>Événements
                </a>
               
            </div>

            <!-- Admin info -->
            <div class="hidden md:flex items-center space-x-4">

                <a href="../public/logout.php"
                   class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-xl font-bold transition">
                    <i class="fas fa-sign-out-alt mr-1"></i>Déconnexion
                </a>
            </div>

            <!-- Mobile -->
            <button id="mobileMenuBtn" class="md:hidden text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden pb-6">
            <div class="flex flex-col space-y-2 mt-4 border-t border-gray-700 pt-4">
                <a href="dashboard.php" class="mobile-admin-link">Dashboard</a>
                <a href="users.php" class="mobile-admin-link">Utilisateurs</a>
                <a href="events_validation.php" class="mobile-admin-link">Événements</a>
                <a href="../public/logout.php" class="mobile-admin-link text-red-400">Déconnexion</a>
            </div>
        </div>
    </div>
</nav>

<style>
.nav-admin-link{
    padding:10px 16px;
    border-radius:12px;
    font-weight:600;
    color:#d1d5db;
}
.nav-admin-link:hover{
    background:#1f2937;
    color:white;
}
.mobile-admin-link{
    padding:12px;
    border-radius:12px;
    background:#1f2937;
    font-weight:600;
}
</style>

<script>
document.getElementById('mobileMenuBtn').onclick = () =>
    document.getElementById('mobileMenu').classList.toggle('hidden');
</script>
