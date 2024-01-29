<?php
    session_start();
    session_destroy();
    header('Location: ../kiosk/stores.php');
?>