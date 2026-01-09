<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">

<?php include '../includes/navbar_organisateur.php'; ?>

<div class="max-w-2xl mx-auto p-6 mt-10 mb-10">
    <!-- En-tête de la page -->
    <div class="text-center mb-8">
        <h2 class="text-4xl font-bold text-gray-800 mb-2">Mon Profil</h2>
        <p class="text-gray-600">Gérez vos informations personnelles</p>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-blue-400 mx-auto mt-4 rounded-full"></div>
    </div>

    <!-- Carte du profil -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        
        <!-- Message de succès -->
        <?php if (isset($_GET['success'])): ?>
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-4 m-6 rounded-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-green-700 font-semibold">Profil mis à jour avec succès !</p>
                </div>
            </div>
        <?php endif; ?>

        <div class="p-8">
            <form method="POST" action="update_profile.php" enctype="multipart/form-data" class="space-y-6">

                <!-- Photo de profil -->
                <div class="text-center">
                    <div class="relative inline-block">
                        <div class="w-32 h-32 rounded-full mx-auto mb-4 ring-4 ring-blue-100 overflow-hidden shadow-lg">
                            <img src="../uploads/avatars/<?= htmlspecialchars($user['photo']) ?>"
                                 class="w-full h-full object-cover"
                                 alt="Photo de profil">
                        </div>
                        <div class="absolute bottom-4 right-0 bg-blue-600 rounded-full p-2 shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <label class="inline-block">
                        <span class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-lg cursor-pointer transition duration-300 inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Changer la photo
                        </span>
                        <input type="file" name="photo" accept="image/*" class="hidden">
                    </label>
                </div>

                
                <div class="border-t border-gray-200 my-6"></div>

                
                <div>
                    <label class="block font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Nom complet
                    </label>
                    <input type="text" name="nom" required
                           value="<?= htmlspecialchars($user['nom']) ?>"
                           class="w-full border-2 border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Adresse email
                    </label>
                    <input type="email" name="email" required
                           value="<?= htmlspecialchars($user['email']) ?>"
                           class="w-full border-2 border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition outline-none">
                </div>

                <!-- Téléphone -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Numéro de téléphone
                    </label>
                    <input type="text" name="telephone" required
                           value="<?= htmlspecialchars($user['telephone']) ?>"
                           class="w-full border-2 border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition outline-none"
                           placeholder="+212 6XX XXX XXX">
                </div>

                <!-- Bouton de soumission -->
                <button class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-4 rounded-xl font-bold transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Enregistrer les modifications
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>