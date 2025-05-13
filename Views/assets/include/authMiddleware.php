<?php
if(isset($_POST[""]) && $_POST[""] == ""){
session_start();
header("Location: ../Auth/index.php");
exit();
}
?>
