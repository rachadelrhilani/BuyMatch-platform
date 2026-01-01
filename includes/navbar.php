<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="home.php" class="flex items-center space-x-2">
                <i class="fas fa-ticket-alt text-blue-600 text-2xl"></i>
                <span class="text-xl font-bold text-gray-800">Buymatch</span>
            </a>

            
            <div class="hidden md:flex items-center space-x-8">
                <a href="home.php" class="text-gray-700 hover:text-blue-600 transition">Accueil</a>
                <a href="#events" class="text-gray-700 hover:text-blue-600 transition">Matchs</a>
                <a href="#about" class="text-gray-700 hover:text-blue-600 transition">À propos</a>
            </div>

            
            <div class="hidden md:flex items-center space-x-4">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <span class="text-gray-700">Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="logout.php" class="px-4 py-2 text-red-600 hover:text-red-700 transition">Déconnexion</a>
                <?php else: ?>
                    <a href="login.php" class="px-4 py-2 text-blue-600 hover:text-blue-700 transition">Connexion</a>
                    <a href="register.php" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">S'inscrire</a>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn" class="md:hidden text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-3">
                <a href="index.php" class="text-gray-700 hover:text-blue-600 transition py-2">Accueil</a>
                <a href="#events" class="text-gray-700 hover:text-blue-600 transition py-2">Matchs</a>
                <a href="#about" class="text-gray-700 hover:text-blue-600 transition py-2">À propos</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <span class="text-gray-700 py-2">Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="logout.php" class="text-red-600 hover:text-red-700 transition py-2">Déconnexion</a>
                <?php else: ?>
                    <a href="login.php" class="text-blue-600 hover:text-blue-700 transition py-2">Connexion</a>
                    <a href="register.php" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center">S'inscrire</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>