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
    
    public function countTicketsByAcheteurAndEvent(int $acheteurId, int $eventId): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(t.id)
            FROM tickets t
            JOIN orders o ON o.id = t.order_id
            JOIN categories c ON c.id = t.category_id
            WHERE o.acheteur_id = ?
              AND c.event_id = ?
        ");
        $stmt->execute([$acheteurId, $eventId]);
        return (int)$stmt->fetchColumn();
    }
    public function createOrder(
    int $acheteurId,
    int $categoryId,
    string $place,
    int $quantite
): Order {

    $this->db->beginTransaction();

    try {
        // 1️⃣ Catégorie
        $stmt = $this->db->prepare("
            SELECT prix
            FROM categories
            WHERE id = ?
        ");
        $stmt->execute([$categoryId]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$category) {
            throw new Exception("Catégorie invalide");
        }

        $total = $category['prix'] * $quantite;

        // 2️⃣ Création order
        $stmt = $this->db->prepare("
            INSERT INTO orders (acheteur_id, total)
            VALUES (?, ?)
        ");
        $stmt->execute([$acheteurId, $total]);
        $orderId = (int)$this->db->lastInsertId();

        // OBJET Order
        $order = new Order($orderId, $acheteurId, $total);

        // 3️⃣ Tickets
        $stmtTicket = $this->db->prepare("
            INSERT INTO tickets (numero, place, order_id, category_id)
            VALUES (?, ?, ?, ?)
        ");

        for ($i = 1; $i <= $quantite; $i++) {
            $numero = strtoupper(uniqid('TKT-'));
            $seat = $place . '-' . $i;

            $stmtTicket->execute([
                $numero,
                $seat,
                $orderId,
                $categoryId
            ]);

            $ticketId = (int)$this->db->lastInsertId();

            $ticket = new Ticket(
                $ticketId,
                $numero,
                $seat,
                $categoryId
            );

            $order->addTicket($ticket);
        }

        $this->db->commit();
        return $order;

    } catch (Exception $e) {
        $this->db->rollBack();
        throw $e;
    }
}

}
