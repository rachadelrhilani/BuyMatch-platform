<?php
require_once '../includes/auth_check.php';
require_once '../repositories/EventRepository.php';

$eventId = (int) $_GET['id'];
$organisateurId = $_SESSION['user']['id'];

$repo = new EventRepository();

if ($repo->deleteEvent($eventId, $organisateurId)) {
    header('Location: my_events.php?success=deleted');
} else {
    header('Location: my_events.php?error=delete_failed');
}
exit;
