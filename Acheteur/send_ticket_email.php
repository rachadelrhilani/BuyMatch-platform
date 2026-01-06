<?php
$requiredRole = 'acheteur';
require_once '../includes/auth_check.php';
require_once '../repositories/OrderRepository.php';
require_once '../utils/PdfGenerator.php';
require_once '../utils/Mailer.php';

$ticketId = (int)$_GET['ticket'];
$userId = $_SESSION['user']['id'];
$email = $_SESSION['user']['email'];

$repo = new OrderRepository();
$ticket = $repo->getTicketById($ticketId, $userId);

$file = sys_get_temp_dir() . "/ticket_$ticketId.pdf";
PdfGenerator::generateTicket($ticket, $file);

Mailer::sendTicket($email, $file);

header("Location: my_tickets.php?sent=1");
exit;
