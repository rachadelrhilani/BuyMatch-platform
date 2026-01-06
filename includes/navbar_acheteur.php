<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'acheteur') {
    header('Location: ../login.php');
    exit;
}

$avatar = !empty($_SESSION['user']['photo'])
    ? "../uploads/avatars/" . $_SESSION['user']['photo']
    : "../uploads/avatars/default.png";
?>

<nav class="bg-white border-b sticky top-0 z-50 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="dashboard.php" class="flex items-center space-x-3">
                <div class="bg-green-600 p-2 rounded-lg">
                    <i class="fas fa-ticket-alt text-white text-xl"></i>
                </div>
                <span class="text-2xl font-black uppercase">
                    Buy<span class="text-green-600">Match</span>
                </span>
            </a>

            <!-- Menu Desktop -->
            <div class="hidden lg:flex space-x-2">
                <a href="dashboard.php" class="nav-client-link">Accueil</a>
                <a href="Profile.php" class="nav-client-link">Profile</a>
                <a href="my_tickets.php" class="nav-client-link">Mes billets</a>
                <a href="my_comments.php" class="nav-client-link">Mes avis</a>
            </div>

            <!-- User -->
            <div class="hidden md:flex items-center space-x-4">
                <div class="text-right">
                        <p class="text-sm font-bold text-gray-900 leading-tight"><?= htmlspecialchars($_SESSION['user']['nom']) ?></p>
                        <p class="text-xs text-blue-600 font-medium"><?= htmlspecialchars($_SESSION['user']['role']) ?></p>
                    </div>
                <img src="<?= htmlspecialchars($avatar) ?>"
                     class="w-10 h-10 rounded-full object-cover border">

                <a href="../public/logout.php"
                   class="px-4 py-2 bg-gray-900 text-white rounded-xl font-bold hover:bg-red-600 transition">
                    Déconnexion
                </a>
            </div>

            <!-- Mobile -->
            <button id="mobileMenuBtn" class="lg:hidden">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden pb-6">
            <div class="flex flex-col space-y-2 mt-4 border-t pt-4">
                <a href="dashboard.php" class="mobile-client-link">Accueil</a>
                <a href="Profile.php" class="mobile-client-link">Profile</a>
                <a href="my_tickets.php" class="mobile-client-link">Mes billets</a>
                <a href="my_comments.php" class="mobile-client-link">Mes avis</a>
                <a href="../public/logout.php" class="mobile-client-link text-red-600">Déconnexion</a>
            </div>
        </div>
    </div>
</nav>

<style>
.nav-client-link{
    padding:10px 16px;
    border-radius:12px;
    font-weight:600;
    color:#374151;
}
.nav-client-link:hover{
    background:#ecfdf5;
    color:#059669;
}
.mobile-client-link{
    padding:12px;
    border-radius:12px;
    background:#f9fafb;
    font-weight:600;
}
</style>

<script>
document.getElementById('mobileMenuBtn').onclick = () =>
    document.getElementById('mobileMenu').classList.toggle('hidden');
</script>
<script src="https://cdn.tailwindcss.com"></script>