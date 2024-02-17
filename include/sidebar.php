<?php
require_once ("../include/head.php");
require_once('../include/js.php');
require_once('../database/datafetch.php');
if(!isset($_SESSION)){
    session_start();
}
if ($_SESSION['role'] !== 'Superadmin') {
    header('Location: ../login/login.php');
    exit; 
}

?>
<div class="left">
        <img class="superadminstorelogo" src="../resources/foodparklogo.png" alt="hhee">
        <div class="options">
            <ul class="options">
                
                <li class="options">
                    <a class="<?php if ($currentpage==='overview'){ echo 'active';}?>" href="overview.php">Overview</a>
                </li>
                <li class="options">
                    <a class="<?php if ($currentpage==='accounts'){ echo 'active';}?>" href="accounts.php">Accounts</a>
                </li>
                <li class="options">
                    <a class="<?php if ($currentpage==='staffs'){ echo 'active';}?>" href="staffs.php">Staffs</a>
                </li>
                <li class="options">
                    <a class="<?php if ($currentpage==='sales'){ echo 'active';}?>" href="sales.php">Sales</a>
                </li>
                <li class="options">
                    <a class="<?php if ($currentpage==='settings'){ echo 'active';}?>" href="settings.php">Settings</a>
                </li>
                <li class="options logout">
                    <a href="../database/logout.php">Logout</a>
                </li>
            </ul>
            
        </div>
    </div>