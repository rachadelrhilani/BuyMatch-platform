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


    public function isPlaceAvailable(int $categoryId, string $place): bool
    {
        $stmt = $this->db->prepare("
        SELECT COUNT(*)
        FROM tickets
        WHERE category_id = ?
          AND place = ?
    ");
        $stmt->execute([$categoryId, $place]);
        return $stmt->fetchColumn() == 0;
    }


    public function createOrder(
        int $acheteurId,
        int $categoryId,
        string $place,
        int $quantite
    ): Order {

        $this->db->beginTransaction();

        try {
            // Categorie
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

            // Creation order
            $stmt = $this->db->prepare("
            INSERT INTO orders (acheteur_id, total)
            VALUES (?, ?)
        ");
            $stmt->execute([$acheteurId, $total]);
            $orderId = (int)$this->db->lastInsertId();

            // OBJET Order
            $order = new Order($orderId, $acheteurId, $total);

            // Tickets
            $stmtTicket = $this->db->prepare("
            INSERT INTO tickets (numero, place, order_id, category_id)
            VALUES (?, ?, ?, ?)
        ");

            for ($i = 1; $i <= $quantite; $i++) {
                $numero = strtoupper(uniqid('TKT-'));
                $seat = $place . '-' . $i;

                if (!$this->isPlaceAvailable($categoryId, $seat)) {
                    throw new Exception("La place $seat est déjà réservée.");
                }

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
    public function getTicketById(int $ticketId, int $userId): array
    {
        $stmt = $this->db->prepare("
        SELECT 
            t.numero,
            t.place,
            c.nom AS categorie,
            e.titre,
    c.prix  AS prix,
            e.date_event,
            e.lieu
        FROM tickets t
        JOIN orders o ON o.id = t.order_id
        JOIN categories c ON c.id = t.category_id
        JOIN events e ON e.id = c.event_id
        WHERE t.id = ?
          AND o.acheteur_id = ?
    ");
        $stmt->execute([$ticketId, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getTicketsByAcheteur(int $userId): array
    {
        $stmt = $this->db->prepare("
       SELECT 
    t.id,
    t.numero,
    t.place,
    c.nom   AS categorie,
    c.prix  AS prix,
    e.titre,
    e.date_event,
    e.lieu
FROM tickets t
JOIN orders o     ON o.id = t.order_id
JOIN categories c ON c.id = t.category_id
JOIN events e     ON e.id = c.event_id
WHERE o.acheteur_id = ?
ORDER BY o.date_commande DESC

    ");

        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
