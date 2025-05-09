<?php
require_once '../../Models/User.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/DBController.php';
    $db = new DBController();
    $db->openConnection();
    $query = "SELECT * FROM user";
    $result = $db->select($query);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Newsstand</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Digital Platform</div>
            <div class="nav-links">
                <a href="arabic-login.html">العربية</a>
                <a href="index.html" class="active">English</a>
            </div>
        </nav>
    </header>

    <main class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form class="login-form" id="loginForm">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" > <!-- required -->
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" > <!-- required -->
                </div>
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>
                <!-- need to check first -->
                <a href="home.html"> <button class="login-button">Login</button> </a>
                <!-- <form action="home.html" method="get">
                    <button type="submit" class="login-button">Login</button>                  
                    </form> -->
                <div class="register-link">
                    <p>Don't have an account? <a href="register.html">Create a New Account</a></p>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2024 Digital Platform. All Rights Reserved</p>
        </div>
    </footer>

    <script src="login.js"></script>
</body>
</html>
