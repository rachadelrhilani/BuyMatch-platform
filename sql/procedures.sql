DELIMITER $$

CREATE PROCEDURE getEventRevenue(IN eventId INT)
BEGIN
    SELECT 
        e.titre,
        SUM(o.total) AS chiffre_affaires
    FROM events e
    JOIN categories c ON c.event_id = e.id
    JOIN tickets t ON t.category_id = c.id
    JOIN orders o ON o.id = t.order_id
    WHERE e.id = eventId;
END $$

DELIMITER ;
