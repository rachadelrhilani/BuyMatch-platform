<?php

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

   
    private string $host = "localhost";
    private string $db_name = "buyMatch";
    private string $username = "root";
    private string $password = "";
    private string $charset = "utf8mb4";

   
    private function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
            $this->connection = new PDO($dsn, $this->username, $this->password);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            echo "connection avec success";

        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

   
    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }


    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
