<?php
$requiredRole = 'acheteur';
require_once '../includes/auth_check.php';
require_once '../repositories/OrderRepository.php';
require_once '../utils/PdfGenerator.php';

$ticketId = (int)$_GET['ticket'];
$userId = $_SESSION['user']['id'];

$repo = new OrderRepository();
$ticket = $repo->getTicketById($ticketId, $userId);

if (!$ticket) {
    die("Ticket introuvable");
}

$file = sys_get_temp_dir() . "/ticket_$ticketId.pdf";

PdfGenerator::generateTicket($ticket, $file);

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="ticket.pdf"');
readfile($file);
exit;
