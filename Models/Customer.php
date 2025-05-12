<?php
require_once '../Controllers/DBController.php';

class Customer {
    
    // Properties
    private $conn;
    private $user_table = "user";
    private $subscription_table = "subscriptions";

    public function __construct() {
        $db = new DBController();
        $db->openConnection();
        $this->conn = $db->conn;
    }

    // purchaseSingleIssue Method
    public function purchaseSingleIssue($issueId, $userId) {
        return true;
    }

    // upgradeToPremium Methid
    public function upgradeToPremium($userId) {
        $query = "UPDATE " . $this->user_table . " 
                 SET userRole = 3 WHERE userId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    public function requestInterestManagement($userId) {
        return ['technology', 'sports', 'politics'];
    }

    public function showInterests($interestsList) {
        return $interestsList;
    }

    public function submitSelectedInterests($userId, $interests) {
        return true;
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>