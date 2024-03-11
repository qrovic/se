<!DOCTYPE html>
<html lang="en">
<?php 
require_once ("../include/head.php");
require_once('../include/js.php');


if (isset($_GET['type'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['type'] = $_GET['type'];
    header("Location: ../kiosk/stores.php");
    exit();
}
?>
<body class="index">
    <div class="indexorder" onclick="window.location.href='../kiosk/type.php?type=Dine-In';">
        <i class='bx bx-restaurant' ></i>
        <p class="indexfont">Dine In</p>
    </div>
    <div class="indexlogin" onclick="window.location.href='../kiosk/type.php?type=Take-Out';">
        <i class='bx bxs-shopping-bag-alt'></i>
        <p class="indexfont">Take Out</p>
    </div>
</body>
</html>