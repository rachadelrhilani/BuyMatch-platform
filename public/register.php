<?php
$pageTitle = "Inscription - BuyMatch";


include '../includes/header.php';
?>

<section class="min-h-screen flex items-center justify-center py-12 px-4 bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-full mb-4">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Créer un compte</h2>
            <p class="text-gray-600 mt-2">Rejoignez Buymatch gratuitement</p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-8">
            <form id="registerForm" method="POST" action="process_register.php">
                <div class="mb-6">
                    <label for="fullname" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-user mr-2 text-blue-600"></i>Nom complet
                    </label>
                    <input type="text" id="fullname" name="fullname" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                           placeholder="Prénom Nom">
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>Email
                    </label>
                    <input type="email" id="email" name="email" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                           placeholder="votre@email.com">
                </div>

                <!-- Phone -->
                <div class="mb-6">
                    <label for="phone" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-phone mr-2 text-blue-600"></i>Téléphone
                    </label>
                    <input type="tel" id="phone" name="phone" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                           placeholder="+212 6XX XXX XXX">
                </div>

                <!-- Password -->
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
                    <p class="text-xs text-gray-500 mt-1">Minimum 8 caractères</p>
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="confirm_password" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Confirmer le mot de passe
                    </label>
                    <div class="relative">
                        <input type="password" id="confirm_password" name="confirm_password" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                               placeholder="••••••••">
                        <button type="button" id="toggleConfirmPassword" class="absolute right-3 top-3.5 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" name="terms" required class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-1">
                        <span class="ml-2 text-sm text-gray-600">
                            J'accepte les <a href="#" class="text-blue-600 hover:text-blue-700">conditions d'utilisation</a> 
                            et la <a href="#" class="text-blue-600 hover:text-blue-700">politique de confidentialité</a>
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition transform hover:scale-105">
                    Créer mon compte
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Ou</span>
                    </div>
                </div>

                <!-- Social Register -->
                <div class="space-y-3">
                    <button type="button" class="w-full py-3 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition flex items-center justify-center">
                        <i class="fab fa-google text-red-500 mr-2"></i>
                        S'inscrire avec Google
                    </button>
                    <button type="button" class="w-full py-3 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition flex items-center justify-center">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i>
                        S'inscrire avec Facebook
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Vous avez déjà un compte? 
                    <a href="login.php" class="text-blue-600 font-semibold hover:text-blue-700">Se connecter</a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="index.php" class="text-gray-600 hover:text-gray-800 transition">
                <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
            </a>
        </div>
    </div>
</section>

<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('confirm_password');

    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        const icon = togglePassword.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', () => {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        
        const icon = toggleConfirmPassword.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });

    // Form validation
    document.getElementById('registerForm').addEventListener('submit', (e) => {
        e.preventDefault();
        
        const fullname = document.getElementById('fullname').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const terms = document.querySelector('input[name="terms"]').checked;

        // Validation
        if(!fullname || !email || !phone || !password || !confirmPassword) {
            alert('Veuillez remplir tous les champs');
            return;
        }

        if(password.length < 8) {
            alert('Le mot de passe doit contenir au moins 8 caractères');
            return;
        }

        if(password !== confirmPassword) {
            alert('Les mots de passe ne correspondent pas');
            return;
        }

        if(!terms) {
            alert('Veuillez accepter les conditions d\'utilisation');
            return;
        }

        // Simulate registration (replace with actual backend call)
        console.log('Registration attempt:', { fullname, email, phone, password });
        
        // For demo purposes
        alert('Inscription réussie! Vous pouvez maintenant vous connecter.');
        window.location.href = 'login.php';
    });
</script>

<?php include '../includes/footer.php'; ?>