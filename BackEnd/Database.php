<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'rnasri_dalit_vasti';
    private $username = 'ehid_db';
    private $password = 'ehid_db@123';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
