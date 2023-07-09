<?php
class Book
{
    private $conn;
    private $table_name = "books";

    public $id;
    public $name;
    public $year;
    public $author;

    public function __construct($db)
    {
        $this->conn = ($db);
    }

    function read()
    {
        $query = "SELECT
            b.id, b.name, b.year, b.author
        FROM 
            " . $this->table_name . " b
        ORDER BY
            b.id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name,
                year=:year,
                author=:author";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->author = htmlspecialchars(strip_tags($this->author));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":author", $this->author);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update()
    {
        $query = "UPDATE
            " . $this->table_name . "
        SET
            name = :name,
            year = :year,
            author = :author
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function search($keywords)
    {
        $query = "SELECT
            b.id, b.name, b.year, b.author
        FROM
            " . $this->table_name . " b
        WHERE
            b.name LIKE ? OR b.year LIKE ? OR b.author LIKE ?
        ORDER BY
            b.id DESC";

        $stmt = $this->conn->prepare($query);

        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        $stmt->execute();

        return $stmt;
    }
}