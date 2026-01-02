<?php
require_once '../classes/Database.php';
require_once '../classes/Event.php';
require_once '../classes/Team.php';

class EventRepository
{
    private $db;


    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function createEvent(array $data, array $files, int $organisateurId): bool
    {
        $this->db->beginTransaction();

        try {
            
            $logo1 = uniqid() . '_' . $files['equipe1_logo']['name'];
            $logo2 = uniqid() . '_' . $files['equipe2_logo']['name'];

            move_uploaded_file($files['equipe1_logo']['tmp_name'], "../uploads/teams/$logo1");
            move_uploaded_file($files['equipe2_logo']['tmp_name'], "../uploads/teams/$logo2");

            
            $stmt = $this->db->prepare("INSERT INTO equipes (nom, logo) VALUES (?, ?)");
            $stmt->execute([$data['equipe1_nom'], $logo1]);
            $equipe1_id = $this->db->lastInsertId();

            $stmt->execute([$data['equipe2_nom'], $logo2]);
            $equipe2_id = $this->db->lastInsertId();

           
            $stmt = $this->db->prepare("
                INSERT INTO events 
                (titre, date_event, lieu, duree, statut, equipe_1_id, equipe_2_id, organisateur_id)
                VALUES (?, ?, ?, ?, 'en_attente', ?, ?, ?)
            ");

            $stmt->execute([
                $data['titre'],
                $data['date_event'],
                $data['lieu'],
                $data['duree'],
                $equipe1_id,
                $equipe2_id,
                $organisateurId
            ]);

            $eventId = $this->db->lastInsertId();

            
            foreach ($data['categories'] as $cat) {
                $stmt = $this->db->prepare("
                    INSERT INTO categories (event_id, nom, prix, capacite)
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->execute([
                    $eventId,
                    $cat['nom'],
                    $cat['prix'],
                    $cat['places']
                ]);
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function updateEvent(int $eventId, int $organisateurId, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE events SET 
                titre = ?, 
                date_event = ?, 
                lieu = ?, 
                duree = ?
            WHERE id = ? AND organisateur_id = ?
        ");

        return $stmt->execute([
            $data['titre'],
            $data['date_event'],
            $data['lieu'],
            $data['duree'],
            $eventId,
            $organisateurId
        ]);
    }


    public function getStatsByOrganisateur(int $id): array
    {
        $sql = "
        SELECT 
            COUNT(t.id) AS billets_vendus,
            SUM(c.prix) AS chiffre_affaires
        FROM events e
        JOIN categories c ON c.event_id = e.id
        JOIN tickets t ON t.category_id = c.id
        WHERE e.organisateur_id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCommentairesByOrganisateur(int $id): array
    {
        $sql = "
        SELECT c.*, u.nom 
        FROM comments c
        JOIN events e ON e.id = c.event_id
        JOIN users u ON u.id = c.user_id
        WHERE e.organisateur_id = ?
        ORDER BY c.created_at DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
    public function findById(int $id): ?Event
    {
        $sql = "SELECT 
            e.*,
            t1.id AS home_id, t1.nom AS home_name, t1.logo AS home_logo,
            t2.id AS away_id, t2.nom AS away_name, t2.logo AS away_logo
        FROM events e
        JOIN equipes t1 ON e.equipe_1_id = t1.id
        JOIN equipes t2 ON e.equipe_2_id = t2.id
        WHERE e.id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $home = new Team($row['home_id'], $row['home_name'], $row['home_logo']);
        $away = new Team($row['away_id'], $row['away_name'], $row['away_logo']);

        return new Event(
            $row['id'],
            $row['titre'],
            new DateTime($row['date_event']),
            $row['lieu'],
            $row['duree'],
            $row['statut'],
            $home,
            $away
        );
    }

    public function filter(?string $search = null, ?string $lieu = null): array
    {
        $sql = "
            SELECT 
                e.id,
                e.titre,
                e.date_event,
                e.lieu,
                e.duree,
                e.statut,
                t1.id AS t1_id, t1.nom AS t1_nom, t1.logo AS t1_logo,
                t2.id AS t2_id, t2.nom AS t2_nom, t2.logo AS t2_logo
            FROM events e
            JOIN equipes t1 ON e.equipe_1_id = t1.id
            JOIN equipes t2 ON e.equipe_2_id = t2.id
            WHERE e.statut = 'valide'
        ";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (t1.nom LIKE :search OR t2.nom LIKE :search OR e.titre LIKE :search)";
            $params['search'] = "%$search%";
        }

        if (!empty($lieu)) {
            $sql .= " AND e.lieu = :lieu";
            $params['lieu'] = $lieu;
        }

        $sql .= " ORDER BY e.date_event ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        $events = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $team1 = new Team($row['t1_id'], $row['t1_nom'], $row['t1_logo']);
            $team2 = new Team($row['t2_id'], $row['t2_nom'], $row['t2_logo']);

            $events[] = new Event(
                $row['id'],
                $row['titre'],
                new DateTime($row['date_event']),
                $row['lieu'],
                (int)$row['duree'],
                $row['statut'],
                $team1,
                $team2
            );
        }

        return $events;
    }
}
