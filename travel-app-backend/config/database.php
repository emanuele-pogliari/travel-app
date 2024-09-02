<?php
class Database
{
    private $host = "localhost"; // Indirizzo del server del database
    private $db_name = "travel-db"; // Nome del database
    private $username = "tuo_username"; // Username del database
    private $password = "tua_password"; // Password del database
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Errore di connessione al database: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
