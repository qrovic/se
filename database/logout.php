<?php
if (!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION)){
    session_destroy();
    header('Location: ../login/login.php');
}
?>