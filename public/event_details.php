<?php
session_start();

require_once '../repositories/EventRepository.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$eventrepo = new EventRepository();
$event = $eventrepo->findById((int)$_GET['id']);

if (!$event) {
    die("Événement introuvable");
}

$pageTitle = "Détails du match";
include '../includes/header.php';
?>


<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">

                <div class="bg-white rounded-lg shadow mb-6 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-3xl font-bold">
                            <?= $event->getEquipeDomicile()->getNom() ?>
                            vs
                            <?= $event->getEquipeExterieure()->getNom() ?>
                        </h1>
                    </div>

                    <div class="flex items-center gap-6 mb-4">
                        <img src="<?= $event->getEquipeDomicile()->getLogo() ?>" class="w-20">
                        <span class="text-2xl font-bold">VS</span>
                        <img src="<?= $event->getEquipeExterieure()->getLogo() ?>" class="w-20">
                    </div>

                    <p class="text-gray-700 mb-2">
                        📍 <?= $event->getLieu() ?>
                    </p>
                    <p class="text-gray-700">
                        📅 <?= $event->getDate()->format('d/m/Y H:i') ?>
                    </p>
                </div>

            </div>

            <!-- SIDEBAR -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 sticky top-20">
                    <h2 class="text-xl font-bold mb-4">Réserver</h2>

                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <div class="bg-yellow-100 p-4 rounded">
                            <p class="text-sm text-yellow-800">
                                Connectez-vous pour réserver.
                            </p>
                        </div>
                    <?php else: ?>
                        <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                            Réserver maintenant
                        </button>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
