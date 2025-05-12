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

    //register method
    public function register(User $user)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Get the user input data and sanitize it
        $name = $this->db->escape($user->getUserName());
        $email = $this->db->escape($user->getUserEmail());
        $password = $this->db->escape($user->getUserPassword());
        $languageId = $user->getLanguageId();

        // Check if the email already exists
        $queryCheckEmail = "SELECT * FROM user WHERE userEmail = '$email'";
        $result = $this->db->select($queryCheckEmail);

        if ($result) {
            $_SESSION['errMsg'] = "This email is already registered.";
            return false;
        }
        

        $query = "INSERT INTO user (userName, userEmail, userPassword, userRole , languageId) 
                VALUES ('$name', '$email', '$password', 2, '$languageId')";

        if ($this->db->execute($query)) {
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
        } else {
            $_SESSION['errMsg'] = "There was an error during registration. Please try again.";
            return false;
        }
    }
}

?>