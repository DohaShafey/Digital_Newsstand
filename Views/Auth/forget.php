<?php

include_once (__DIR__ . "/../../Controllers/AuthController.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController();
    $email = $_POST['email'] ?? '';
    if ($auth->forgetPassword($email)) {
        $_SESSION['Msg'] = $_SESSION['Msg'] ?? "Reset link sent to your email.";
    } else {
        $_SESSION['Msg'] = $_SESSION['Msg'] ?? "Error sending reset link.";
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password - Digital Newsstand</title>
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
            <h2>Forgot Password</h2>
            <form class="login-form" id="forgotPasswordForm" method="POST" action="forget.php">
                <?php
                if (!empty($_SESSION['Msg'])) {
                    echo '<div class="error-message">' . htmlspecialchars($_SESSION['Msg']) . '</div>';
                    unset($_SESSION['Msg']);
                }
                ?>
                <div class="form-group">
                    <label for="email">Enter your email address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button class="login-button" type="submit" name="submit">Send Reset Link</button>

                <div class="register-link">
                    <p>Remember your password? <a href="index.php">Go back to Login</a></p>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="footer-bottom">
            <p>&copy; 2024 Digital Platform. All Rights Reserved</p>
        </div>
    </footer>
</body>
</html>
