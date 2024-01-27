
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
            <form action="storesearch.php" method="POST">
            <input class="searchstores" type="text" name="search" id="" placeholder="Search for stores and menu">
            <input type="text" name=storename hidden value=<?php echo $_POST['storename'];?>>
          
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
                    <form id="" action="menu.php" method="POST" hidden>
                        <input type="text" id="storename" name="storename" value="<?php echo $store['name'];?>" hidden>
                        <button type="submit" id="<?php echo $store['name'];?>" style="display:none;"></button>
                    </form>
                    <div class="kioskstore" onclick="document.getElementById('<?php echo $store['name'];?>').click()">
                    <img class="storelogo" src="<?php echo "../resources/" . $store['pic']; ?>" onerror="this.src='../resources/noimg.png'";>
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