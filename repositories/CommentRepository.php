<?php

require_once '../classes/Database.php';
require_once '../classes/Comment.php';

class CommentRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

     public function hasUserCommented(int $userId, int $eventId): bool
    {
        $stmt = $this->db->prepare("
            SELECT id FROM comments
            WHERE user_id = ? AND event_id = ?
        ");
        $stmt->execute([$userId, $eventId]);
        return (bool) $stmt->fetch();
    }
    /**
     * Ajouter un commentaire
     */
    public function addComment(
        int $userId,
        int $eventId,
        string $contenu,
        int $note
    ): bool {
        $stmt = $this->db->prepare("
            INSERT INTO comments (contenu, note, user_id, event_id)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $contenu,
            $note,
            $userId,
            $eventId
        ]);
    }

    /**
     * Récupérer les commentaires d’un événement
     */
    public function getCommentsByEvent(int $eventId): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM comments
            WHERE event_id = ? AND statut = 'visible'
            ORDER BY created_at DESC
        ");
        $stmt->execute([$eventId]);

        $comments = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new Comment(
                $row['id'],
                $row['contenu'],
                (int)$row['note'],
                $row['statut']
            );
        }

        return $comments;
    }

    /**
     * Récupérer les commentaires écrits par un utilisateur
     */
    public function getCommentsByUser(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM comments
            WHERE user_id = ?
            ORDER BY created_at DESC
        ");
        $stmt->execute([$userId]);

        $comments = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new Comment(
                $row['id'],
                $row['contenu'],
                (int)$row['note'],
                $row['statut']
            );
        }

        return $comments;
    }
}
