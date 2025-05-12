<?php
session_start();
include_once (__DIR__ . "/../../Controllers/AuthController.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController();

    $userId = $_SESSION['user']['userId'] ?? null;

    $newInfo = [
        'userName' => $_POST['name'] ?? '',
        'userEmail' => $_POST['email'] ?? '',
        'userPassword' => $_POST['password'] ?? ''
    ];

    if ($auth->updateInfo($userId, $newInfo)) {
        header("location: account.php");
    } else {
        echo $_SESSION['errMsg'] ?? "Failed to update info.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information - Digital Newsstand</title>
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
            <h2>Update Information</h2>
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
                
                                
                    <button type="submit" class="register-button">Update</button>
            </form>
        </div>
    </main>
</body>
<?php require_once '../assets/include/footer.php'; ?>
</html>