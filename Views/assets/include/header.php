<?php
session_start();
require_once ('../../Models/User.php');
require_once ('../../Controllers/DBController.php');
// عرّفي الصفحة الحالية بناءً على المتغير اللي بينرسل
$currentPage = basename($_SERVER['PHP_SELF']);

/*$conn = new DBController();

if (isset($_SESSION['user'])) {
    $userRoleQuery = "SELECT userRole FROM user";
    $userRole = $conn->select($userRoleQuery);
    if (!$userRole) { 
        exit("");
    }
    else {
        $userRole = $userRole[0]['userRole'] == 1; 
    }
} 

else {
    // مثلاً توجيه المستخدم لصفحة تسجيل الدخول
    header("Location: ../Auth/index.php");
    exit();
}*/

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($currentPage) ? $currentPage : "Digital Newsstand" ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/<?php echo pathinfo($currentPage, PATHINFO_FILENAME); ?>.css">
    <?php if($currentPage == "account.php"){ ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php } ?>
</head>
<body>
<header>
    <nav>
        <a href="../test/home.php" style="text-decoration: none;"> 
            <div class="logo">Digital Platform</div> 
        </a>        

        <!-- لازم تتعدل و يكون الشرط على اساس اليوظيفه بتاعت اليوزر -->
        <div class="nav-links">
            <a href="../test/home.php" class="<?= $currentPage === 'home.php' ? 'active' : '' ?>">Home</a>
            <a href="../test/news.php" class="<?= $currentPage === 'news.php' ? 'active' : '' ?>">For'U</a>
            <a href="../test/sections.php" class="<?= $currentPage === 'sections.php' ? 'active' : '' ?>">Sections</a>
            <a href="../Client/favorites.php" class="<?= $currentPage === 'favorites.php' ? 'active' : '' ?>">Favorites</a>
            <?php if (($_SESSION['user']['userRole'])==1) {?>
                <a href="../Admin/admin.php" class="<?= $currentPage === 'admin.php' ? 'active' : '' ?>">Manage</a> 
            <?php }
            else{ ?> 
                <a href="../Client/subscription.php" class="<?= $currentPage === 'subscription.php' ? 'active' : '' ?>">Subscription</a> 
            <?php } ?>
            <a href="../test/account.php" class="login-btn <?= $currentPage === 'account.php' ? 'active' : '' ?>">Account</a>
        </div>
    </nav>
</header>

<?php /*
session_start();
require_once ('../../Models/User.php');
require_once ('../../Controllers/DBController.php');
// عرّفي الصفحة الحالية بناءً على المتغير اللي بينرسل
$currentPage = basename($_SERVER['PHP_SELF']);

// $conn = new DBController();

// if ($_SESSION['check']) {
//     $userRoleQuery = "SELECT userRole FROM user";
//     $userRole = $conn->select($userRoleQuery);
//     if (!$userRole) { 
//         exit("");
//     }
//     else {
//         $userRole = $userRole[0]['userRole'] == 1; 
//     }
// } 

// else {

//     header("Location: ../Auth/index.php");
//     exit();
// }





// session_start();
// require_once ('../../Models/User.php');
// require_once ('../../Controllers/DBController.php');

// $currentPage = basename($_SERVER['PHP_SELF']);

// $conn = new DBController();
// $conn->openConnection();

// if (isset($_SESSION['user'])) {
//     $user = $_SESSION['user'];
//     $userId = $conn->escape($user['userId']);

//     $query = "SELECT userRole FROM user WHERE userId = $userId";
//     $result = $conn->select($query);

//     if ($result && count($result) > 0) {
//         $userRole = $result[0]['userRole'] == 1;
//         $_SESSION['userRole'] = $result[0]['userRole']; // للتخزين المستقبلي
//         // ممكن تعملي تحويل لهوم لو هاي الصفحة خاصة بالتشييك:
//         header("Location: ../test/home.php");
//         exit();
//     } 
//     else {
//         echo "No data found or query failed.";
//         exit();
//     }
// } else {
//     header("Location: ../Auth/index.php");
//     exit();
// }

// $conn->closeConnection();
?>
*/
/*
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($currentPage) ? $currentPage : "Digital Newsstand" ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/<?php echo pathinfo($currentPage, PATHINFO_FILENAME); ?>.css">
    <?php if($currentPage == "account.php"){ ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php } ?>
</head>
<body>
<header>
    <nav>
        <a href="../test/home.php" style="text-decoration: none;"> 
            <div class="logo">Digital Platform</div> 
        </a>        

        <!-- لازم تتعدل و يكون الشرط على اساس اليوظيفه بتاعت اليوزر -->
        <div class="nav-links">
            <a href="../test/home.php" class="<?= $currentPage === 'home.php' ? 'active' : '' ?>">Home</a>
            <a href="../test/news.php" class="<?= $currentPage === 'news.php' ? 'active' : '' ?>">News</a>
            <a href="../test/sections.php" class="<?= $currentPage === 'sections.php' ? 'active' : '' ?>">Sections</a>
            <a href="../Client/favorites.php" class="<?= $currentPage === 'favorites.php' ? 'active' : '' ?>">Favorites</a>
            <?php if (($_SESSION['user']['userRole']['0'])==1) {?>
                <a href="../Admin/admin.php" class="<?= $currentPage === 'admin.php' ? 'active' : '' ?>">Manage</a> 
            <?php }
            else{ ?> 
                <a href="../Client/subscription.php" class="<?= $currentPage === 'subscription.php' ? 'active' : '' ?>">Subscription</a> 
            <?php } ?>
            <a href="../test/account.php" class="login-btn <?= $currentPage === 'account.php' ? 'active' : '' ?>">Account</a>
        </div>
    </nav>
</header>
*/