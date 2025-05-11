<?php

include_once(__DIR__ . "../../Models/User.php");
include_once(__DIR__ . "../../Controllers/DBController.php");

class AuthController
{
    protected $db;

    public function __construct()
    {
        $this->db = new DBController;
    }

    //login method
    public function login(User $user)
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userEmail = $user->getUserEmail();
        $userPassword = $user->getUserPassword();

        if ($this->db->openConnection()) {
            $query = "SELECT * FROM user WHERE userEmail = '$userEmail' AND userPassword = '$userPassword'";
            $result = $this->db->select($query);
            if ($result === false) {
                $_SESSION['errMsg'] = "Error in query";
                return false;
            } else {
                if (count($result) == 0) {
                    $_SESSION['errMsg'] = "You have entered wrong email or password.";
                    return false;
                } else {
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
        }
    }

    //registeration method
    public function register(User $user)
    {
        $this->db = new DBContoller;
        if ($this->db->openConnection()) {
            $query = "INSERT INTO `user` VALUES('','$user->getUserName()')";
        }
    }
}

?>



<?php
/* 
require_once '../../Models/User.php';
require_once '../../Controllers/DBController.php';
class AuthController {
    protected $db;

    
    public function login(User $user) {
        $db =new DBController();
        $userEmail = $user->getUserEmail();
        $userPassword = $user->getPassword();
        if($db->openConnection()){
            $query = "SELECT * FROM user WHERE userEmail = '$userEmail' AND userPassword = '$userPassword'";
            $result = $this->db->select($query);
            if(!$result){
                echo "Error: ". $db->lastErrorMsg();
                return false;
            }
            else{
                return true;
            }

        }

        deleted

        if ($result && count($result) === 1) {
            $user = $result[0];
            if ($password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            }
        }

        return false; 
    }

    public function logout() {
        session_unset();
        session_destroy();
    }

    public function isLoggedIn() {
        return isset($_SESSION['userId']);
    }

    public function getCurrentUser() {
        if ($this->isLoggedIn()) {
            return [
                'userId' => $_SESSION['userId'],
                'userName' => $_SESSION['userName']
            ];
        }
        return null;
    }
}
?>
*/