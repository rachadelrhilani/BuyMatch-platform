<?php

require_once '../classes/Database.php';

class AdminRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getGlobalStats(): array
    {
        return [
            'users' => $this->db->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            'events' => $this->db->query("SELECT COUNT(*) FROM events")->fetchColumn(),
            'tickets' => $this->db->query("SELECT COUNT(*) FROM tickets")->fetchColumn(),
            'revenue' => $this->db->query("
                SELECT IFNULL(SUM(total),0)
                FROM orders
            ")->fetchColumn()
        ];
    }

    public function getReportedComments(): array
    {
        $stmt = $this->db->query("
            SELECT 
                c.id,
                c.contenu,
                c.note,
                c.statut,
                u.nom AS user_nom,
                e.titre AS event_titre,
                c.created_at
            FROM comments c
            JOIN users u ON u.id = c.user_id
            JOIN events e ON e.id = c.event_id
            WHERE c.statut = 'visible'
            ORDER BY c.created_at DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCommentStatus(int $commentId, string $status): void
    {
        $stmt = $this->db->prepare("
            UPDATE comments
            SET statut = ?
            WHERE id = ?
        ");
        $stmt->execute([$status, $commentId]);
    }
    public function getAllUsers(): array
    {
        $stmt = $this->db->query("
            SELECT id, nom, email, role, actif, created_at
            FROM users
            WHERE role != 'admin'
            ORDER BY created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function toggleUserStatus(int $userId): void
    {
        $stmt = $this->db->prepare("
            UPDATE users
            SET actif = NOT actif
            WHERE id = ?
        ");
        $stmt->execute([$userId]);
    }
     
}
