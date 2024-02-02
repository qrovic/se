
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
    $itemvariants=$_POST['itemvariants2'];
    $itemsizes=$_POST['itemsizes2'];
    $itemprices=$_POST['itemprices'];
    $itemstocks=$_POST['itemstocks'];
    /*foreach ($itemvariants as $key1 => $value){
        echo $value;
        echo "<br>";
        
        foreach($itemsizes as $key2 => $values){
            
            echo $values;
            echo "<br>";
            echo "<br>";
           
    
            echo "<br>";
            echo $itemprices[($key1-1)];
            echo $itemstocks[($key2-1)];
            echo "<br>";
            
            /*foreach ($itemstocks as $key => $valuesss){
                echo $valuesss;
                echo "<br>";
            }*/
            
        //}
        echo "<br>";
    //}
    //for 1 variant many sizes
    /*foreach($itemsizes as $key2 => $values){
            
        echo $values;
        echo "<br>";
        echo "<br>";
       

        echo "<br>";
        echo $itemprices[($key2-1)];
        echo $itemstocks[($key2-1)];
        echo "<br>";
        
        /*foreach ($itemstocks as $key => $valuesss){
            echo $valuesss;
            echo "<br>";
        }*/
        
    //}
    // for many variant, 1 size
    /*foreach($itemvariants as $key1 => $values){
        echo $values;
        echo "<br>";
        echo "<br>";
       

        echo "<br>";
        echo $itemprices[($key1-1)].$itemstocks[($key1-1)];
        echo "<br>";
        
        /*foreach ($itemstocks as $key => $valuesss){
            echo $valuesss;
            echo "<br>";
        }*/
        
    //}
    


    
    
    
    
    
    
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
                        /*if (!$_POST['itemsizes']){
                            ?>
                            <div class="sizedetails">
                                <div class="addstoreinput">
                                    <input type="number" name="itemprices[]">
                                </div>

                                <div class="addstoreinput"> 
                                    <input type="number" name="itemstocks[]">
                                </div>
                            </div>
                            <?php
                        }*/
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
                    //if (isset($_POST['itemvariants']) && is_array($_POST['itemvariants'])) {
                    if (isset($_POST['itemvariants'])) {
                        $i = 0; 
                        foreach ($_POST['itemvariants'] as $itemvariant) {
                            $i++; 
                            ?>
                            <input type="text" name="itemvariants2[<?php echo $i; ?>]" value="<?php echo htmlspecialchars($itemvariant); ?>" hidden>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    
                    if (isset($_POST['itemsizes'])) {
                        $j = 0; 
                        foreach ($_POST['itemsizes'] as $itemsize) {
                            $j++; 
                            ?>
                            <input type="text" name="itemsizes2[<?php echo $j; ?>]" value="<?php echo htmlspecialchars($itemsize); ?>" hidden>
                            <?php
                        }
                    }
                    ?>
                    <input type="text" name="itempic" id="" value="<?php echo $_POST['itempic'];?>" hidden>
                    <input type="number" name="storeid" id="" value="<?php echo $_POST['storeid'];?>" hidden>
                    <input type="text" name="itemname" id="" value="<?php echo $_POST['itemname'];?>" hidden>
                    <input type="text" name="itemcategory" id="" value="<?php echo $_POST['itemcategory'];?>" hidden>
                    <input type="submit" id="submitbtn" value="Submit">       
                
            </div>
            

        </div>
        </form>               
    </div>
</body>


</html>