<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
    if(!isset($_SESSION)){
        session_start();
    }
    if (!isset($_SESSION['storestoreid'])){
        header('Location:../login/login.php');
    }
    include_once("../database/newcustomer.php");
    require_once('../database/popular.php');
?>
<div class="left">
        <?php foreach ($storedeets AS $storedeet){ 
            $_SESSION['storename']=$storedeet['name']; 
            $_SESSION['storeid']=$storedeet['id']; 
            $storename=$_SESSION['storename'];
            ?>
            
        <img class="superadminstorelogo" src="../resources/foodparklogo.png" alt="hhee">
        <?php } ?>
        <div class="options">
            <ul class="options">
                <?php if($_SESSION['role']=='Manager' || $_SESSION['role']=='Owner'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='overview'){ echo 'active';}?>" href="overview.php">Overview</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Cashier' || $_SESSION['role']=='Manager'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='payment'){ echo 'active';}?>" href="orders.php">Payment</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Cook' || $_SESSION['role']=='Manager'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='orders'){ echo 'active';}?>" href="orderspaid.php">Orders</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Cashier' || $_SESSION['role']=='Manager'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='cashier'){ echo 'active';}?>" href="cashier.php">Cashier</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Manager' || $_SESSION['role']=='Owner'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='menus'){ echo 'active';}?>" href="menus.php">Menus</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Manager' || $_SESSION['role']=='Owner'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='staffs'){ echo 'active';}?>" href="staffs.php">Staffs</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Manager' || $_SESSION['role']=='Owner'){ ?>
                <li class="options">
                <a class="<?php if ($currentpage === 'queue') { echo 'active'; } ?>" href="storequeue.php" target="_blank">Queue</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Manager' || $_SESSION['role']=='Owner'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='sales'){ echo 'active';}?>" href="sales.php">Sales</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Manager' || $_SESSION['role']=='Owner'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='settings'){ echo 'active';}?>" href="settings.php">Settings</a>
                </li>
                <?php } ?>
                <li class="options logout">
                    <a href="../database/logout.php">Logout</a>
                </li>
            </ul>
            
        </div>
    </div>