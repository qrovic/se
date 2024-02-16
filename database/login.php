<?php
require_once('../database/config.php');

if (isset($POST['email']) && isset($POST['password'])){
    $email=$POST['email'];
    $password=$POST['password'];

    $sqlsalltores = "SELECT * FROM store";
    $stmt = $pdo->prepare($sqlsalltores); 
    $stmt->execute();  
    $allstores = $stmt->fetchAll();

}


?>