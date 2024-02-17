<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    if(!isset($_SESSION)){
        session_start();
    }
    if (isset($_SESSION['role'])){
        if($_SESSION['role']=='Superadmin'){
            header('Location: ../superadmin/overview.php');
        }elseif($_SESSION['role']=='Cashier'){
            header('Location: ../store/orders.php');
        }
    }
?>
<body>
    <div class="login-left">
        <img src="../resources/foodparklogo.png" alt="bwwbw "><br>
        <h2 class="login-text">Login</h2>
    </div>
    <div class="login-right">
        <form action="../database/login.php" method="POST">
            <?php if(isset($_SESSION['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                <?php if ($_SESSION['error']=='incorrect'){ echo 'Incorrect email or password.';} else{ echo 'No user found.';}?>
                </div>
            <?php } ?>
            
            <label class="login-label" for="">Email</label><br>    
            <input class="form-control" id="login-input" type="email" name="email" id="">
            <label class="login-label" for="">Password</label><br>    
            <input class="form-control" id="login-input" type="password" name="password" id=""><br>
            
            <input id="login-submit" class="form-control" type="submit" value="Login">
        </form>
    </div>
</body>
</html>