CREATE VIEW vue_matchs_a_venir AS
SELECT
    e.id AS event_id,
    e.titre,
    e.date_event,
    e.lieu,
    COUNT(t.id) AS tickets_vendus
FROM events e
LEFT JOIN categories c ON c.event_id = e.id
LEFT JOIN tickets t ON t.category_id = c.id
WHERE e.statut = 'valide'
  AND e.date_event > NOW()
GROUP BY e.id;
