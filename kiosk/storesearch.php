
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
          
        </form>
        </div>
        <div class="accountstext" id="storestext">
            <p>We found <?php if($filteredstorescount){ echo $filteredstorescount;} else{echo "0";}?> <?php if(($filteredstorescount)>1){ echo "results";}else{echo "result";}?> for "<?php if ($_POST['search']){ echo $_POST['search'];}?>"</p>
        </div>
        <div class="kioskstores" onclick="examplemodal">
            <?php
            if ($filteredstores) {
                foreach ($filteredstores as $store) {
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