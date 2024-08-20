<?php
class Stage
{
    private $conn;
    private $table_name = "stages";

    public $id;
    public $day_id;
    public $title;
    public $description;
    public $location;
    public $image;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (day_id, title, description, location, image) VALUES (:day_id, :title, :description, :location, :image)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':day_id', $this->day_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':image', $this->image);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE day_id = :day_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':day_id', $this->day_id);
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

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET title = :title, description = :description, location = :location, image = :image WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':image', $this->image);
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
