<?php 

include_once (__DIR__ . "/../../Controllers/ValidationController.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validator = new ValidationController;
    $fields = ['name', 'email', 'password', 'language'];
    $success = $validator->handleAuthRequest($fields, 'register');

    if ($success) {
        header("Location: ../test/home.php");
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
            <form class="register-form" id="registerForm" method="POST">
            <?php if (!empty($errorMsg)){ ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($errorMsg); ?>
                </div>
            <?php } ?>
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
                        <option value="1">English</option>
                        <option value="2">Arabic</option>
                        <option value="3">French</option>
                        <option value="4">Spanish</option>
                        <option value="5">German</option>
                        <option value="6">Chinese</option>
                        <option value="7">Japanese</option>
                        <option value="8">Korean</option>
                        <option value="9">Russian</option>
                        <option value="10">Portuguese</option>
                        <option value="11">Italian</option>
                        <option value="12">Hindi</option>
                        <option value="13">Turkish</option>
                        <option value="14">Persian</option>
                        <option value="15">Urdu</option>
                        <option value="16">Dutch</option>
                    </select>
                </div>
                            
                <button type="submit" class="register-button">Register</button>
            </form>

            <div class="login-link">
                <p>Already have an account? <a href="index.php">Login here</a></p>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2024 Digital Platform. All Rights Reserved</p>
        </div>
    </footer>

    <!--<script src="../assets/js/register.js"></script>-->
</body>
</html>
