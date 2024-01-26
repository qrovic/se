
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
       
?>
<body class="storebody">
    <div class="header">
        <img class="kioskstorelogo" src="../resources/foodparklogo.png" alt="hhee" onclick="window.location.href='stores.php'">
    </div>
    <div class="storeheader">
        <div class="menustorename">
            <p><?php if (isset($_GET['storename'])) { echo $_GET['storename']; } ?></p>
        </div>
        <div class="menusearch">
            <form action="stores.php" method="get">
            <input class="menusearch" type="text" name="search" id="" placeholder="Search for stores and menu">
            </form>
            <div class="categories">
                <p class="active">POpular</p>
                <p class="active">Drinks</p>
                <p>Meals</p>
                <p>Snacks</p>
                <p>Desserts</p>
                <p>Combo</p>
            </div>
        </div>
        
    </div>
    <div class="storemenus">
        <div class="menustorename">
            <p>Drinks</p>
        </div>
        <div class="storeitems" onclick="examplemodal">
            <?php
            if ($drinks) {
                foreach ($drinks as $drink) {
                    ?>
                    <div class="storeitem">
                        <div class="itemdetails">
                            <p class="itemname"><?php echo $drink['name'] ?></p>
                            <p class="itemprice">from <?php echo rand(50, 199);?></p>
                        </div>
                        <img class="storelogo" src="<?php echo "../resources/" . $drink['pic']; ?>" alt="Store Logo">
                        
                    </div>
                    <?php 
                }
            }
            ?>
        </div>
    </div>
</body>
</html>