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
    public function getCommentairesByAcheteur(int $userId): array
    {
        $sql = "
        SELECT 
            c.id AS comment_id,
            c.contenu,
            c.note,
            c.created_at,

            e.id AS event_id,
            e.titre AS event_titre,

            eq1.nom AS equipe1_nom,
            eq1.logo AS equipe1_logo,
            eq2.nom AS equipe2_nom,
            eq2.logo AS equipe2_logo

        FROM comments c
        INNER JOIN events e ON e.id = c.event_id
        INNER JOIN equipes eq1 ON eq1.id = e.equipe_1_id
        INNER JOIN equipes eq2 ON eq2.id = e.equipe_2_id
        WHERE c.user_id = :user_id
        ORDER BY c.created_at DESC
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function getUserCommentForEvent(int $userId, int $eventId): ?Comment
    {
        $sql = "
        SELECT *
        FROM comments
        WHERE user_id = :user_id
          AND event_id = :event_id
        LIMIT 1
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'event_id' => $eventId
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Comment(
            $row['id'],
            $row['contenu'],
            (int)$row['note'],
            $row['statut'],
            null,
            $row['created_at']
        );
    }
}
