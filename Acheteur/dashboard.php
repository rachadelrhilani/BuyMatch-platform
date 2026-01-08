<?php 
$requiredRole = 'acheteur';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';
require_once '../repositories/CommentRepository.php';

$eventRepo = new EventRepository();
$commentRepo = new CommentRepository();

$availableEvents = $eventRepo->getAvailableEvents();
$finishedEvents  = $eventRepo->getFinishedEvents();
$userId = $_SESSION['user']['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-Acheteur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <?php require_once '../includes/navbar_Acheteur.php'; ?>
    
    <!-- Section Matchs disponibles -->
    <div class="max-w-7xl mx-auto p-6 mt-8">
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-1 h-8 bg-gradient-to-b from-blue-600 to-blue-400 rounded-full"></div>
                <h2 class="text-3xl font-bold text-gray-800">Matchs disponibles</h2>
            </div>
            <p class="text-gray-600 ml-6">Réservez vos billets pour les prochains événements</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6">
            <?php foreach ($availableEvents as $event): ?>
                <div class="group bg-white shadow-lg hover:shadow-2xl rounded-2xl overflow-hidden transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <!-- En-tête avec dégradé -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-4">
                        <h3 class="font-bold text-lg text-white line-clamp-1">
                            <?= htmlspecialchars($event['titre']) ?>
                        </h3>
                    </div>

                    <div class="p-6">
                        <!-- VS Section avec logos -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 mb-4">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col items-center flex-1">
                                    <div class="bg-white rounded-full p-3 shadow-md mb-2 transform group-hover:scale-110 transition-transform duration-300">
                                        <img src="../uploads/teams/<?= htmlspecialchars($event['equipe1_logo']) ?>"
                                            class="w-16 h-16 object-contain"
                                            alt="<?= htmlspecialchars($event['equipe1_nom']) ?>">
                                    </div>
                                    <span class="font-bold text-center text-sm text-gray-800">
                                        <?= htmlspecialchars($event['equipe1_nom']) ?>
                                    </span>
                                </div>

                                <div class="flex flex-col items-center px-4">
                                    <span class="text-3xl font-black text-gray-800 group-hover:text-blue-600 transition-colors">VS</span>
                                    <div class="w-12 h-1 bg-gradient-to-r from-blue-600 to-blue-400 rounded-full mt-2"></div>
                                </div>

                                <div class="flex flex-col items-center flex-1">
                                    <div class="bg-white rounded-full p-3 shadow-md mb-2 transform group-hover:scale-110 transition-transform duration-300">
                                        <img src="../uploads/teams/<?= htmlspecialchars($event['equipe2_logo']) ?>"
                                            class="w-16 h-16 object-contain"
                                            alt="<?= htmlspecialchars($event['equipe2_nom']) ?>">
                                    </div>
                                    <span class="font-bold text-center text-sm text-gray-800">
                                        <?= htmlspecialchars($event['equipe2_nom']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Informations du match -->
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center gap-3 text-gray-700">
                                <div class="bg-blue-100 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="font-semibold"><?= date('d/m/Y à H:i', strtotime($event['date_event'])) ?></span>
                            </div>

                            <div class="flex items-center gap-3 text-gray-700">
                                <div class="bg-green-100 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <span class="font-semibold"><?= htmlspecialchars($event['lieu']) ?></span>
                            </div>
                        </div>

                        <!-- Bouton d'achat -->
                        <a href="buy_ticket.php?event=<?= $event['id'] ?>"
                            class="block text-center bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl font-bold hover:from-blue-700 hover:to-blue-800 transition duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Acheter un billet
                            </span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Section Matchs terminés -->
    <div class="max-w-7xl mx-auto p-6 mt-12 mb-12">
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-1 h-8 bg-gradient-to-b from-gray-600 to-gray-400 rounded-full"></div>
                <h2 class="text-3xl font-bold text-gray-800">Matchs terminés</h2>
            </div>
            <p class="text-gray-600 ml-6">Partagez votre expérience et notez les matchs</p>
        </div>

        <div class="space-y-6">
            <?php foreach ($finishedEvents as $event): ?>
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-xl">
                    <!-- En-tête gris pour les matchs terminés -->
                    <div class="bg-gradient-to-r from-gray-600 to-gray-700 p-4 flex items-center justify-between">
                        <h3 class="font-bold text-lg text-white"><?= htmlspecialchars($event['titre']) ?></h3>
                        <span class="bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full">Terminé</span>
                    </div>

                    <div class="p-6">
                        <!-- VS Section -->
                        <div class="bg-gray-50 rounded-xl p-4 mb-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3 flex-1">
                                    <div class="bg-white rounded-full p-2 shadow">
                                        <img src="../uploads/teams/<?= htmlspecialchars($event['equipe1_logo']) ?>"
                                            class="w-12 h-12 object-contain">
                                    </div>
                                    <span class="font-bold text-gray-800"><?= htmlspecialchars($event['equipe1_nom']) ?></span>
                                </div>

                                <span class="text-2xl font-black text-gray-400 px-4">VS</span>

                                <div class="flex items-center gap-3 flex-1 justify-end">
                                    <span class="font-bold text-gray-800"><?= htmlspecialchars($event['equipe2_nom']) ?></span>
                                    <div class="bg-white rounded-full p-2 shadow">
                                        <img src="../uploads/teams/<?= htmlspecialchars($event['equipe2_logo']) ?>"
                                            class="w-12 h-12 object-contain">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!$commentRepo->hasUserCommented($userId, $event['id'])): ?>
                            <!-- Formulaire de commentaire -->
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border-2 border-blue-100">
                                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    Donnez votre avis
                                </h4>
                                
                                <form method="POST" action="add_comment.php" class="space-y-4">
                                    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Votre commentaire</label>
                                        <textarea name="contenu" required
                                            rows="4"
                                            class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition outline-none resize-none"
                                            placeholder="Partagez votre expérience du match..."></textarea>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Note du match</label>
                                        <select name="note" required 
                                            class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition outline-none font-semibold">
                                            <option value="">Choisissez une note</option>
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <option value="<?= $i ?>">
                                                    <?= str_repeat('⭐', $i) ?> (<?= $i ?>/5)
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                    <button class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3 rounded-xl font-bold hover:from-green-700 hover:to-green-800 transition duration-300 shadow-md hover:shadow-lg transform hover:scale-105 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        Publier mon avis
                                    </button>
                                </form>
                            </div>
                        <?php else: ?>
                            <!-- Message de confirmation -->
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-4">
                                <p class="text-green-700 font-bold flex items-center gap-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Vous avez déjà donné votre avis sur ce match
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>