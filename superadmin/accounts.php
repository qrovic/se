
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
                    <a  href="overview.php">Overview</a>
                </li>
                <li class="options">
                    <a class="active" href="overview.php">Accounts</a>
                </li>
                <li class="options">
                    <a href="overview.php">Sales</a>
                </li>
                <li class="options">
                    <a href="overview.php">Settings</a>
                </li>
                <li class="options logout">
                    <a href="overview.php">Logout</a>
                </li>
            </ul>
            
        </div>
    </div>
    <div class="right" id="rightaccount">
        <div class="accountstext">
            <p>Accounts</p>
        </div>
        
        <div class="accountsdiv" onclick="examplemodal">
            <?php
            if ($stores) {
                foreach ($stores as $store) {
                    ?>
                    <div class="acoountdiv">
                        <img class="accountlogo" src="<?php echo "../resources/" . $store['pic']; ?>" alt="Store Logo">
                        <div class="storename">
                            <p class="accountname"><?php echo $store['name'] ?></p>
                        </div>
                    </div>
                    <?php 
                }
            }
            ?>
        </div>
    </div>
    

    <div class="addstore">
        <button type="button" class="btn btn-primary" id="add-store" data-toggle="modal" data-target="#addMemberModal">
            Add Store
        </button>
    </div>
    

</body>
</html>