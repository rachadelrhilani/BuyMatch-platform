<?php
$requiredRole = 'admin';
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';

if (!isset($_GET['id'], $_GET['statut'])) {
    header('Location: events.php');
    exit;
}

$eventId = (int) $_GET['id'];
$statut = $_GET['statut'];

$repo = new EventRepository();

try {
    $repo->updateStatut($eventId, $statut);
} catch (Exception $e) {
    die($e->getMessage());
}

header('Location: events.php');
exit;
