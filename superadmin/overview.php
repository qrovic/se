
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
?>
<body>
    <div class="left">
        <img class="superadminstorelogo" src="../resources/foodparklogo.png" alt="hhee">
        <div class="options">
            <ul class="options">
                <li class="options">
                    <a class="active" href="overview.php">Overview</a>
                </li>
                <li class="options">
                    <a href="accounts.php">Accounts</a>
                </li>
                <li class="options">
                    <a href="overview.php">Sales</a>
                </li>
                <li class="options">
                    <a href="overview.php">Settings</a>
                </li>
                <li class="options logout">
                    <a href="../login/login.php">Logout</a>
                </li>
            </ul>
            
        </div>
    </div>
    <div class="right">
        <div class="storestat">
            <div class="stores">
                <p class="storenumber"><?php if($totalstorescount){ echo $onlinestorescount;}?></p>
                <div class="storestext">
                    <p>STORES</p>
                    <p>OPEN</p>
                </div>
                
            </div>
            <div class="stores">
                <p class="storenumber"><?php if($totalstorescount){ echo $totalstorescount;}?></p>
                <div class="storestext">
                    <p>TOTAL</p>
                    <p>STORES</p>
                </div>
                
            </div>
        </div>
    </div>


    

</body>
</html>