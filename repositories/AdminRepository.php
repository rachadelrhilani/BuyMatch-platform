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
