<?php

include_once (__DIR__ . "/../../Controllers/ValidationController.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validator = new ValidationController;
    $fields = ['email', 'password'];
    $success = $validator->handleAuthRequest($fields, 'login');

    if ($success) {
        $_SESSION['check'] = $success;
        header("Location: ../test/home.php");
        $_SESSION['check'] = $success;
        exit();
    } else {
        $errorMsg = $_SESSION['errMsg'] ?? "Invalid login.";
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Newsstand</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Digital Platform</div>
            <div class="nav-links">
                <a href="arabic-login.html">العربية</a>
                <a href="index.php" class="active">English</a>
            </div>
        </nav>
    </header>

    <main class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form class="login-form" id="loginForm" method="POST">
            <?php if (!empty($errorMsg)){ ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($errorMsg); ?>
                </div>
            <?php } ?>
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
                    <a href="forget.php" class="forgot-password">Forgot Password?</a>
                </div>
                <!-- need to check first -->
                <button class="login-button" type="submit" name="submit">Login</button>
                <!-- <form action="home.html" method="get">
                    <button type="submit" class="login-button">Login</button>                  
                    </form> -->
                <div class="register-link">
                    <p>Don't have an account? <a href="register.php">Create a New Account</a></p>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2024 Digital Platform. All Rights Reserved</p>
        </div>
    </footer>

    <!--<script src="login.js"></script>-->
</body>
</html>