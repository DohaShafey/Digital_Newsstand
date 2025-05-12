<?php

include_once (__DIR__ . "/../Models/User.php");
include_once (__DIR__ . "/DBController.php");

class AuthController
{
    protected $db;

    public function __construct()
    {
        $this->db = new DBController;
        $this->db->openConnection();
    }

    //login method
    public function login(User $user)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = $this->db->escape($user->getUserEmail());
        $password = $this->db->escape($user->getUserPassword());

        $query = "SELECT * FROM user WHERE userEmail = '$email' AND userPassword = '$password'";
        $result = $this->db->select($query);

        if ($result === false) {
            $_SESSION['errMsg'] = "Error in query";
            return false;
        }

        if (count($result) == 0) {
            $_SESSION['errMsg'] = "You have entered wrong email or password.";
            return false;
        }

        session_regenerate_id(true);
        $_SESSION['user'] = [
            'userId' => $result[0]['userId'],
            'userName' => $result[0]['userName'],
            'userEmail' => $result[0]['userEmail'],
            'userPassword' => $result[0]['userPassword'],
            'userRole' => $result[0]['userRole'],
            'languageId' => $result[0]['languageId']
        ];

        return true;
    }
}

?>
