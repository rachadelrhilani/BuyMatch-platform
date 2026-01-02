<?php
session_start();
$pageTitle = "Connexion - BuyMatch";



include '../includes/header.php';
?>

<section class="min-h-screen flex items-center justify-center py-12 px-4 bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="max-w-md w-full">

        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-full mb-4">
                <i class="fas fa-ticket-alt text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Connexion</h2>
            <p class="text-gray-600 mt-2">Accédez à votre compte BuyMatch</p>
        </div>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="text-red-600 bg-red-100 p-3 rounded-lg mb-4 border border-red-200">
                <?= htmlspecialchars($_SESSION['error']); ?>
            </div>
            <?php unset($_SESSION['error']); // Supprime le message après l'affichage 
            ?>
        <?php endif; ?>
        <div class="bg-white rounded-lg shadow-xl p-8">
            <form id="loginForm" method="POST" action="process_login.php">
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>Email
                    </label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        placeholder="votre@email.com">
                </div>


                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Mot de passe
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute right-3 top-3.5 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>





                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition transform hover:scale-105">
                    Se connecter
                </button>


                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Ou</span>
                    </div>
                </div>



            </form>


            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Vous n'avez pas de compte?
                    <a href="register.php" class="text-blue-600 font-semibold hover:text-blue-700">Créer un compte</a>
                </p>
            </div>
        </div>


        <div class="text-center mt-6">
            <a href="index.php" class="text-gray-600 hover:text-gray-800 transition">
                <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
            </a>
        </div>
    </div>
</section>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        const icon = togglePassword.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
</script>

<?php include '../includes/footer.php'; ?>