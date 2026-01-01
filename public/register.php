<?php
$pageTitle = "Inscription - BuyMatch";
include '../includes/header.php';
require_once '../repositories/UserRepository.php';

$userRepo = new UserRepository();
$success = false;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $userRepo->register($_POST, $_FILES);
    if ($user) {
        $success = "Ajouter avec success";
    } else {
        $error = "Cet email est déjà utilisé.";
    }
}
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
        <?php if ($success): ?>
            <p class="text-green-600 bg-green-100 p-3 rounded-lg mb-4">
                <?= htmlspecialchars($success); ?>
            </p>
        <?php endif; ?>

        <div class="bg-white rounded-lg shadow-xl p-8">
            <form id="registerForm" method="POST">

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="firstname" class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-user mr-2 text-blue-600"></i>Prénom
                        </label>
                        <input type="text" id="firstname" name="firstname" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            placeholder="Jean">
                    </div>
                    <div>
                        <label for="lastname" class="block text-gray-700 font-semibold mb-2">
                            Nom
                        </label>
                        <input type="text" id="lastname" name="lastname" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            placeholder="Dupont">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>Email
                    </label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        placeholder="votre@gmail.com">
                </div>

                <div class="mb-6">
                    <label for="phone" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-phone mr-2 text-blue-600"></i>Téléphone
                    </label>
                    <input type="tel" id="phone" name="phone" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        placeholder="+212 6XX XXX XXX">
                </div>

                <div class="mb-6">
                    <label for="role" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-user-tag mr-2 text-blue-600"></i>Type de compte
                    </label>
                    <select id="role" name="role" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition bg-white">
                        <option value="acheteur">Acheteur</option>
                        <option value="organisateur">Organisateur</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="photo" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-camera mr-2 text-blue-600"></i>Photo de profil
                    </label>
                    <input type="file" id="photo" name="photo" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition
                                  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">Obligatoire pour les acheteurs et organisateurs</p>
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

                <div class="mb-6">
                    <label for="confirm_password" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Confirmer le mot de passe
                    </label>
                    <div class="relative">
                        <input type="password" id="confirm_password" name="confirm_password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" name="terms" required class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-1">
                        <span class="ml-2 text-sm text-gray-600">
                            J'accepte les <a href="#" class="text-blue-600 hover:text-blue-700">conditions d'utilisation</a>
                        </span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition transform hover:scale-105">
                    Créer mon compte
                </button>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm"><span class="px-2 bg-white text-gray-500">Ou</span></div>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">Vous avez déjà un compte? <a href="login.php" class="text-blue-600 font-semibold hover:text-blue-700">Se connecter</a></p>
            </div>
        </div>
    </div>
</section>


<?php include '../includes/footer.php'; ?>