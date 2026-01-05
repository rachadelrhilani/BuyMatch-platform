<?php

require_once '../classes/Database.php';
require_once '../classes/Order.php';
require_once '../classes/Ticket.php';

class OrderRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Créer une commande pour un acheteur
     */
    public function createOrder(int $acheteurId, float $total): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO orders (acheteur_id, total)
            VALUES (?, ?)
        ");
        $stmt->execute([$acheteurId, $total]);

        return (int)$this->db->lastInsertId();
    }

    /**
     * Ajouter un ticket à une commande (composition)
     */
    public function addTicketToOrder(
        int $orderId,
        int $categoryId,
        string $numero,
        string $place,
        ?string $qrCode = null
    ): void {
        $stmt = $this->db->prepare("
            INSERT INTO tickets (numero, place, qr_code, order_id, category_id)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $numero,
            $place,
            $qrCode,
            $orderId,
            $categoryId
        ]);
    }

    /**
     * Récupérer les commandes d’un acheteur avec leurs tickets
     */
    public function getOrdersByAcheteur(int $acheteurId): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM orders
            WHERE acheteur_id = ?
            ORDER BY date_commande DESC
        ");
        $stmt->execute([$acheteurId]);

        $orders = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $order = new Order(
                $row['id'],
                new DateTime($row['date_commande'])
            );

            // Tickets (composition)
            $ticketsStmt = $this->db->prepare("
                SELECT * FROM tickets WHERE order_id = ?
            ");
            $ticketsStmt->execute([$row['id']]);

            while ($t = $ticketsStmt->fetch(PDO::FETCH_ASSOC)) {
                $ticket = new Ticket(
                    $t['id'],
                    $t['numero'],
                    $t['place'],
                    $t['qr_code']
                );
                $order->ajouterTicket($ticket);
            }

            $orders[] = $order;
        }

        return $orders;
    }
}
