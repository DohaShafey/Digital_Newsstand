<?php

require_once '../Controllers/DBController.php';

class Notification {
    private $conn;
    private $table_name = "notification";

    // Properties
    public $content;
    public $type;
    public $userId;

    public function __construct() {
        $db = new DBController();
        $db->openConnection();
        $this->conn = $db->conn;
    }

    // ManageNotification method
    public function manageNotification($action, $notificationData = []) {
        switch ($action) {
            case 'create':
                $query = "INSERT INTO " . $this->table_name . " 
                         (content, type, userId) VALUES (?, ?, ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("ssi", 
                    $notificationData['content'],
                    $notificationData['type'],
                    $notificationData['userId']
                );
                return $stmt->execute();

            case 'delete':
                $query = "DELETE FROM " . $this->table_name . " WHERE userId = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $notificationData['userId']);
                return $stmt->execute();

            default:
                return false;
        }
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>