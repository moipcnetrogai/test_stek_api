<?php
class Database
{
    /*private $host = $env["DB_HOST"];
    private $db_name = $env["DB_NAME"];
    private $username = $env["DB_USERNAME"];
    private $password = $env["DB_PASSWORD"];*/
    public $conn;

    public function getConnection($start = false)
    {
        $env = parse_ini_file('../../.env');
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $env["DB_HOST"] . ";dbname=" . $env["DB_NAME"], $env["DB_USERNAME"], $env["DB_PASSWORD"]);
            if ($start) {
                $query = file_get_contents("dump.sql");
                $stmt = $this->conn->prepare($query);
                if ($stmt->execute()) {
                    echo "Success";
                } else {
                    echo "Fail";
                }
            }
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Ошибка подключения: " . $exception->getMessage();
        }

        return $this->conn;
    }
}