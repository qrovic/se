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
?>
<div class="left">
        <img class="superadminstorelogo" src="../resources/foodparklogo.png" alt="hhee">
        <div class="options">
            <ul class="options">
                <?php if($_SESSION['role']=='Manager'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='overview'){ echo 'active';}?>" href="overview.php">Overview</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Cashier'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='payment'){ echo 'active';}?>" href="orders.php">Payment</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Cook'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='orders'){ echo 'active';}?>" href="orderspaid.php">Orders</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Manager'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='menus'){ echo 'active';}?>" href="menus.php">Menus</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Manager'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='staffs'){ echo 'active';}?>" href="staffs.php">Staffs</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Manager'){ ?>
                <li class="options">
                <a class="<?php if ($currentpage === 'queue') { echo 'active'; } ?>" href="storequeue.php" target="_blank">Queue</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Manager'){ ?>
                <li class="options">
                    <a class="<?php if ($currentpage==='sales'){ echo 'active';}?>" href="sales.php">Sales</a>
                </li>
                <?php } ?>
                <?php if($_SESSION['role']=='Manager'){ ?>
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