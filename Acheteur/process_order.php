<?php
$requiredRole = 'acheteur';
require_once '../includes/auth_check.php';
require_once '../repositories/OrderRepository.php';

$acheteurId = $_SESSION['user']['id'];

$eventId    = (int)$_POST['event_id'];
$categoryId = (int)$_POST['categorie_id'];
$place      = trim($_POST['place']);
$quantite   = (int)$_POST['quantite'];

$orderRepo = new OrderRepository();

// 🔒 Vérification limite billets
$alreadyBought = $orderRepo->countTicketsByAcheteurAndEvent($acheteurId, $eventId);

if ($alreadyBought + $quantite > 4) {
    die("❌ Vous ne pouvez pas acheter plus de 4 billets pour ce match.");
}

try {
    /** @var Order $order */
    $order = $orderRepo->createOrder(
        $acheteurId,
        $categoryId,
        $place,
        $quantite
    );

    // ✅ Optionnel : stocker l'order en session
    $_SESSION['last_order_id'] = $order->getId();

    // Redirection
    header("Location: my_tickets.php?order=" . $order->getId());
    exit;

} catch (Exception $e) {
    die("❌ Erreur lors de l'achat : " . $e->getMessage());
}
