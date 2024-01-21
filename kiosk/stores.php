
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
       
?>
<body class="storebody">
    <div class="header">
        <img class="kioskstorelogo" src="../resources/foodparklogo.png" alt="hhee">
    </div>
    
    </div>
    <div class="down">
        <div class="kiosksearch">
            <form action="stores.php" method="get">
            <input class="searchstores" type="text" name="search" id="" placeholder="Search for stores and menu">
          
        </form>
        </div>
        <div class="accountstext" id="storestext">
            <p>All stores</p>
        </div>
        <div class="kioskstores" onclick="examplemodal">
            <?php
            if ($stores) {
                foreach ($stores as $store) {
                    ?>
                    <div class="kioskstore" onclick="window.location.href='menu.php?storename=<?php echo $store['name'];?>'">
                        <img class="storelogo" src="<?php echo "../resources/" . $store['pic']; ?>" alt="Store Logo">
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
    
    

</body>
</html>