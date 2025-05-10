<?php
require_once '../../Models/User.php';
require_once '../../Controllers/DBController.php';
class AuthController {
    protected $db;

    
    // تسجيل الدخول
    public function login(User $user) {
        $db =new DBController();
        if($db->openConnection()){
            $query = "SELECT * FROM user WHERE userEmail = '$user->userEmail' AND userPassword = '$user->userPassword'";
            $result = $this->db->select($query);
            if(!$result){
                echo "Error: ". $db->lastErrorMsg();
                return false;
            }
            else{
                return true;
            }

        }

        // if ($result && count($result) === 1) {
        //     $user = $result[0];
        //     // تحقق من الباسورد (يفضل يكون مشفّر باستخدام password_hash)
        //     if ($password === $user['password']) {
        //         $_SESSION['user_id'] = $user['id'];
        //         $_SESSION['username'] = $user['username'];
        //         return true;
        //     }
        // }

        // return false; // فشل تسجيل الدخول
    }

    // تسجيل الخروج
    public function logout() {
        session_unset();
        session_destroy();
    }

    // التحقق من إذا المستخدم مسجّل دخول
    public function isLoggedIn() {
        return isset($_SESSION['userId']);
    }

    // جلب بيانات المستخدم الحالي
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
