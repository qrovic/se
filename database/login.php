<?php
require_once('../database/config.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM staff WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if(!isset($_SESSION)){
        session_start();
    }
    if (!$user){
        $_SESSION['error']='nouser';
        header('Location: ../login/login.php');
    }
    if ($user && password_verify($password, $user['password'])) {
        $storeid = $user['storeid'];
        $role = $user['role'];
        $name = $user['fname'];

        if (!isset($_SESSION['role'])){
            $_SESSION['role']=$role;
        }
        if (!isset($_SESSION['name'])){
            $_SESSION['name']=$name;
        }

        if (!isset($_SESSION['storeid'])){
            $_SESSION['storestoreid']=$storeid;
        }
        if ($role=='Superadmin'){
            header('Location: ../superadmin/overview.php');
        }else{
            header('Location: ../store/overview.php');
        }
         
    } else {
            
        $_SESSION['error']='incorrect';
        header('Location: ../login/login.php');
    }
}
?>
