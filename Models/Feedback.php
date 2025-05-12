<?php

require_once '../Controllers/DBController.php';

class Feedback {
    private $conn;
    private $table_name = "feedback";

    // Properties
    public $feedbackId; 
    public $userId;      
    public $comment;     
    public $feedbackDate; 
    public $status;     

    public function __construct() {
        $db = new DBController();
        $db->openConnection();
        $this->conn = $db->conn;
    }

    // the method 
    public function makeFeedback($userId, $comment) {
      $query = "INSERT INTO {$this->table_name} 
        (userId, feedbackComment, feedbackStatus, feedbackDate)
        VALUES (?, ?, 'pending', CURRENT_TIMESTAMP())";

      $stmt = $this->conn->prepare($query);
       if (!$stmt) {
         die("Prepare failed: " . $this->conn->error);
         return false;
       }

      $stmt->bind_param("is", $userId, $comment);

       if (!$stmt->execute()) {
         die("Execute failed: " . $stmt->error);
         return false;
        }

    return $this->conn->insert_id;
    }
    


    // Close connection
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
