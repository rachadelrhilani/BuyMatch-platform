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

    
}
