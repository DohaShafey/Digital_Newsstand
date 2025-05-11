<?php 

include_once (__DIR__ . "/../../Models/User.php");
include_once (__DIR__ . "/../../Controllers/AuthController.php");
include_once (__DIR__ . "/../../Controllers/ValidationController.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validator = new ValidationController();
    $fields = ['userName', 'email', 'password', 'languageId'];
    $success = $validator->handleAuthRequest($fields, 'register');

    if ($success) {
        header("Location: ../home.php");
        exit;
    } else {
        $errorMsg = $_SESSION['errMsg'] ?? "Registeration faild.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Digital Newsstand</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Digital Platform</div>
            <div class="nav-links">
                <a href="arabic-register.html">العربية</a>
                <a href="register.html" class="active">English</a>
            </div>
        </nav>
    </header>

    <main class="register-container">
        <div class="register-box">
            <h2>Create Account</h2>
            <form class="register-form" id="registerForm" action="register.php" method="POST">
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
            
                <!-- قائمة اختيار اللغة -->
                <div class="form-group">
                    <label for="language">Preferred Language</label>
                    <select id="language" name="language" required>
                        <option value="" disabled selected>Select a language</option>
                        <option>English</option>
                        <option>Arabic</option>
                        <option>French</option>
                        <option>Spanish</option>
                        <option>German</option>
                        <option>Chinese</option>
                        <option>Japanese</option>
                        <option>Korean</option>
                        <option>Russian</option>
                        <option>Portuguese</option>
                        <option>Italian</option>
                        <option>Hindi</option>
                        <option>Turkish</option>
                        <option>Persian</option>
                        <option>Urdu</option>
                        <option>Dutch</option>
                    </select>
                </div>
                            
                <button type="submit" class="register-button">Register</button>
            </form>

            <div class="login-link">
                <p>Already have an account? <a href="index.html">Login here</a></p>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2024 Digital Platform. All Rights Reserved</p>
        </div>
    </footer>

    <script src="../assets/js/register.js"></script>
</body>
</html>
