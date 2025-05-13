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

        $name = $this->db->escape($user->getUserName());
        $email = $this->db->escape($user->getUserEmail());
        $password = $this->db->escape($user->getUserPassword());
        $languageId = $user->getLanguageId();

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
            
            $data = $this->db->select($queryCheckEmail);
            $_SESSION['user'] = [
                'userId' => $data[0]['userId'],
                'userName' => $data[0]['userName'],
                'userEmail' => $data[0]['userEmail'],
                'userPassword' => $data[0]['userPassword'],
                'userRole' => $data[0]['userRole'],
                'languageId' => $data[0]['languageId']
            ];
            return true;
        } else {
            $_SESSION['errMsg'] = "There was an error during registration. Please try again.";
            return false;
        }
    }

    //forget password method
    public function forgetPassword($email)
    {
        $email = $this->db->escape($email);
        $query = "SELECT * FROM user WHERE userEmail = '$email'";
        $result = $this->db->select($query);

        if ($result && count($result) > 0) {
            $token = bin2hex(random_bytes(16)); // generate a reset token
            $_SESSION['reset_token'] = $token;
            $_SESSION['reset_user'] = $email;

            $subject = "Password Reset Request";
            $message = "Click the following link to reset your password:\n\n$resetLink";
            $headers = "From: no-reply@digitalnewsstand.com";

            if (mail($email, $subject, $message, $headers)) {
                $_SESSION['Msg'] = "Password reset link sent to your email.";
                return true;
            } else {
                $_SESSION['Msg'] = "Failed to send email. Try again.";
                return false;
            }
        } else {
            $_SESSION['Msg'] = "Email not found.";
            return false;
        }
    }

    //update info method
    public function updateInfo($userId, array $newInfo)
    {
        if (!$userId) {
            $_SESSION['errMsg'] = "No user session found.";
            return false;
        }

        $name = $this->db->escape($newInfo['userName'] ?? '');
        $email = $this->db->escape($newInfo['userEmail'] ?? '');
        $password = $this->db->escape($newInfo['userPassword'] ?? '');

        $query = "UPDATE user SET userName = '$name', userEmail = '$email', userPassword = '$password' WHERE userId = '$userId'";

        if ($this->db->execute($query)) {
            $selectquery = "SELECT * FROM user WHERE userId = '$userId'";
            $data = $this->db->select($selectquery);

            if ($data && count($data) > 0) {
                $_SESSION['user'] = [
                    'userId' => $data[0]['userId'],
                    'userName' => $data[0]['userName'],
                    'userEmail' => $data[0]['userEmail'],
                    'userPassword' => $data[0]['userPassword'],
                    'userRole' => $data[0]['userRole'],
                    'languageId' => $data[0]['languageId']
                ];
                return true;
            } else {
                $_SESSION['errMsg'] = "User not found after update.";
                return false;
            }
        } else {
            $_SESSION['errMsg'] = "Update failed.";
            return false;
        }
    }

    //logout method
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header("Location: ../Views/Auth/index.php");
        exit;
    }
}

?>