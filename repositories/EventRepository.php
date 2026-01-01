<?php
require_once '../classes/Database.php';
require_once '../classes/Event.php';
require_once '../classes/Team.php';

class EventRepository
{
    public static function getAll(): array
    {
        $db = Database::getInstance()->getConnection();

        $sql = "
            SELECT 
                e.*, 
                t1.id AS home_id, t1.nom AS home_name, t1.logo AS home_logo,
                t2.id AS away_id, t2.nom AS away_name, t2.logo AS away_logo
            FROM events e
            JOIN equipes t1 ON e.equipe_1_id = t1.id
            JOIN equipes t2 ON e.equipe_2_id = t2.id
            WHERE e.statut = 'valide'
            ORDER BY e.date_event ASC
        ";

        $stmt = $db->query($sql);
        $events = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $home = new Team($row['home_id'], $row['home_name'], $row['home_logo']);
            $away = new Team($row['away_id'], $row['away_name'], $row['away_logo']);

            $events[] = new Event(
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

        return $events;
    }
}
