<?php

class DBController {
    public $dbHost = "localhost";
    public $dbUser = "root";
    public $dbPassword = "";
    public $dbName = "digital newsstand";
    public $conn;

    public function openConnection() {
        $this->conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
        return true; 
    }

    // Method to run SELECT queries ------------- done
    public function select($query) {
        $result = $this->conn->query($query);
        if ($result) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        }
        return false;
    }

    public function execute($query) {
        return $this->conn->query($query);
    }

    // Method to escape strings (to prevent SQL injection) ------------ done
    public function escape($string) {
        return $this->conn->real_escape_string($string);
    }

    // Close the connection (optional) ------------- done
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

?>
