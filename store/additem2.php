
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php')
?>
<body>
    <div class="left">
        <div class="options">
            <ul class="options">
                <li class="options">
                    <a href="overview.php">Overview</a>
                </li>
                <li class="options">
                    <a href="overview.php">Accounts</a>
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
    <div class="right">
        <h1>Add Store</h1>
        <div class="addstore">
        <form action="../database/additem.php" method="POST" enctype="multipart/form-data">
            <div class="ownerdetails" id="ownerdetails">
                <h2>Variations and sizing</h2>
                    <div class="additem2formheader">
                        <p>Variation</p> 
                        <p>Price</p>
                        <p>STock</p>
                    </div>
                    <?php 
                    $itemvariants=$_POST['itemvariants'];
                    $itemsizes=$_POST['itemsizes'];
                    foreach ($itemvariants as $value) {
                        echo "<br>";
                        echo $value;
                        echo "<br>";
                        foreach ($itemsizes as $values) {
                            ?>
                            <div class="sizedetails">
                            <?php    
                                echo $values;
                                ?>
                                <div class="addstoreinput">
                                    <input type="number" name="itemprices[]">
                                </div>

                                <div class="addstoreinput"> 
                                    <input type="number" name="itemstocks[]">
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    if (isset($_POST['itemvariants']) && is_array($_POST['itemvariants'])) {
                        $i = 0; 
                        foreach ($_POST['itemvariants'] as $itemvariant) {
                            $i++; 
                            ?>
                            <input type="text" name="itemvariants2[<?php echo $i; ?>]" value="<?php echo htmlspecialchars($itemvariant); ?>">
                            <?php
                        }
                    }
                    ?>
                    <?php
                    if (isset($_POST['itemsizes']) && is_array($_POST['itemsizes'])) {
                        $j = 0; 
                        foreach ($_POST['itemsizes'] as $itemsize) {
                            $j++; 
                            ?>
                            <input type="text" name="itemsizes2[<?php echo $j; ?>]" value="<?php echo htmlspecialchars($itemsize); ?>">
                            <?php
                        }
                    }
                    ?>
                    <input type="text" name="itempic" id="" value=<?php echo $_POST['itempic'];?>>
                    <input type="number" name="storeid" id="" value=<?php echo $_POST['storeid'];?>>
                    <input type="text" name="itemname" id="" value=<?php echo $_POST['itemname'];?>>
                    <input type="text" name="itemcategory" id="" value=<?php echo $_POST['itemcategory'];?>>
                    <input type="submit" id="submitbtn" value="Submit">       
                
            </div>
            

        </div>
        </form>               
    </div>
</body>


</html>