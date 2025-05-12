<?php

include_once (__DIR__ . "/../Models/User.php");
include_once (__DIR__ . "/DBController.php");
include_once (__DIR__ . "/AuthController.php");

class ValidationController 
{
    public function handleAuthRequest(array $requiredFields, string $action)
    {
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                $_SESSION['errMsg'] = "Missing or empty field: $field. Please enter all fields.";
                return false;
            }
        }

        $user = new User;
        $auth = new AuthController;
        $db = new DBController;

        $db->openConnection(); 

        $user->setUserEmail($db->escape($_POST['email'] ?? null));
        $user->setUserPassword($db->escape($_POST['password'] ?? null));
        $user->setUserName($db->escape($_POST['userName'] ?? null));
        $user->setLanguageId($db->escape($_POST['languageId'] ?? null));

        switch ($action) {
            case 'login':
                return $auth->login($user);
            case 'register':
                return $auth->register($user);
            default:
                $_SESSION['errMsg'] = "Invalid action: $action.";
                return false;
        }
    }
}        

?>
