<?php

class ValidationController
{
    public function handleAuthRequest(array $requiredFields, string $action)
    {
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                $_SESSION['errMsg'] = "Missing fields, please eneter all fields.";
                return false;
            }
        }

        $user = new User;
        $auth = new AuthController;

        if (isset($_POST['email'])) {
            $user->setUserEmail($_POST['email']);
        }
        if (isset($_POST['password'])) {
            $user->setUserPassword($_POST['password']);
        }
        if (isset($_POST['userName'])) {
            $user->setUserName($_POST['userName']);
        }
        if (isset($_POST['languageId'])) {
            $user->setLanguageId($_POST['languageId']);
        }

        if ($action === 'login') {
            return $auth->login($user);
        } elseif ($action === 'register') {
            return $auth->register($user);
        }

        $_SESSION['errMsg'] = "Invalid action";
        return false;
    }
}
