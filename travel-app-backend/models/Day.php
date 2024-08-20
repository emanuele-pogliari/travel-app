<?php
class Day
{
    private $conn;
    private $table_name = "days";

    public $id;
    public $trip_id;
    public $day_number;
    public $date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (trip_id, day_number, date) VALUES (:trip_id, :day_number, :date)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':trip_id', $this->trip_id);
        $stmt->bindParam(':day_number', $this->day_number);
        $stmt->bindParam(':date', $this->date);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE trip_id = :trip_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':trip_id', $this->trip_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getStops()
    {
        $query = "SELECT * FROM stops WHERE day_id = :day_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':day_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET trip_id = :trip_id, day_number = :day_number, date = :date WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':trip_id', $this->trip_id);
        $stmt->bindParam(':day_number', $this->day_number);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
