<?php
require_once '../classes/Database.php';
require_once '../classes/Event.php';
require_once '../classes/Team.php';

class EventRepository
{

    public static function findById(int $id): ?Event
    {
        $db = Database::getInstance()->getConnection();


        $sql = "SELECT 
            e.*,
            t1.id AS home_id, t1.nom AS home_name, t1.logo AS home_logo,
            t2.id AS away_id, t2.nom AS away_name, t2.logo AS away_logo
        FROM events e
        JOIN equipes t1 ON e.equipe_1_id = t1.id
        JOIN equipes t2 ON e.equipe_2_id = t2.id
        WHERE e.id = :id";

        $stmt = $db->prepare($sql);
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
    public static function filter(?string $search = null, ?string $lieu = null): array
    {
        $db = Database::getInstance()->getConnection();

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
            $sql .= " AND (
            t1.nom LIKE :search 
            OR t2.nom LIKE :search 
            OR e.titre LIKE :search
        )";
            $params['search'] = "%$search%";
        }

        if (!empty($lieu)) {
            $sql .= " AND e.lieu = :lieu";
            $params['lieu'] = $lieu;
        }

        $sql .= " ORDER BY e.date_event ASC";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        $events = [];

        while ($row = $stmt->fetch()) {
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
