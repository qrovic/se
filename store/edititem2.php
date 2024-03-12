
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');

    $itempic = $_FILES['itempic']['name'];
    if (isset($_FILES["itempic"]) && $_FILES["itempic"]["error"] == 0) {
        $destinationFolder = "../resources/";
        $tempName = $_FILES["itempic"]["tmp_name"];
        $destinationPath = $destinationFolder . $_FILES["itempic"]["name"];
        if (move_uploaded_file($tempName, $destinationPath)) {
            //echo "okiiiii";
        } else {
            //echo "di okay";
        }
    } else {
        //echo "di okayy";
    }
    //$itemvariants=$_POST['itemvariants2'];
    //$itemsizes=$_POST['itemsizes2'];
    //$itemprices=$_POST['itemprices'];
    //$itemstocks=$_POST['itemstocks'];
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
    <?php
        $currentpage='menus';
        require_once('../include/sidebarstore.php');
    ?>
    <div class="right">
        <div class="additemdiv">
        <div class="sizedetails headeradditem2">
                           
            <p class="sizetxt varietytxtheader"></p>
            
            <div class="addstoreinput">
                <p class="pricestocktxt">Price</p>
                
            </div>
            
            <div class="addstoreinput"> 
                <p class="pricestocktxt">Stock</p>
            </div>
        </div>
        <form action="../database/edititem.php" method="POST" enctype="multipart/form-data">
            <div class="ownerdetails additem2" id="ownerdetails">
                    
                    <?php 
                    if (isset($_POST['itemvariants']) && isset($_POST['itemsizes'])){
                        $itemvariants=$_POST['itemvariants'];
                        $itemsizes=$_POST['itemsizes'];
                        foreach ($itemvariants as $value) {?>
                            <p class="variantstxt"><?php echo $value;?></p>
                            <hr class="hradditem">
                            <?php
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
                            
                                    <p class="sizetxt"><?php echo $values;?></p>
                                    
                                    <div class="addstoreinput">
                                    <input class="form-control" type="number" name="itemprices[]" step="0.01">
                                        
                                    </div>

                                    <div class="addstoreinput"> 
                                        <input class="form-control" type="number" name="itemstocks[]">
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    } elseif(isset($_POST['itemvariants']) && !isset($_POST['itemsizes'])){
                        $itemvariants=$_POST['itemvariants'];
                        foreach ($itemvariants as $value) {?>
                            <p class="variantstxt"><?php echo $value;?></p>
                            <hr class="hradditem">
                            
                            
                            <div class="sizedetails">
                                
                                <p class="sizetxt"><?php echo 'Regular';?></p>
                                
                                <div class="addstoreinput">
                                <input class="form-control" type="number" name="itemprices[]" step="0.01">
                                    
                                </div>

                                <div class="addstoreinput"> 
                                    <input class="form-control" type="number" name="itemstocks[]">
                                </div>
                            </div>
                            <?php
                        }
                    }elseif(isset($_POST['itemsizes']) && !isset($_POST['itemvariants'])){
                        
                            $itemsizes=$_POST['itemsizes'];
                            ?>
                            <p class="variantstxt"><?php echo 'Regular';?></p>
                            <hr class="hradditem">
                            <?php
                            foreach ($itemsizes as $values) {
                                ?>
                                <div class="sizedetails">
                            
                                    <p class="sizetxt"><?php echo $values;?></p>
                                    
                                    <div class="addstoreinput">
                                    <input class="form-control" type="number" name="itemprices[]" step="0.01">
                                        
                                    </div>

                                    <div class="addstoreinput"> 
                                        <input class="form-control" type="number" name="itemstocks[]">
                                    </div>
                                </div>
                                <?php
                            }
                        
                    }else{ ?>
                        <p class="variantstxt"><?php echo 'Regular';?></p>
                        <hr class="hradditem">
                        <div class="sizedetails">
                            
                            <p class="sizetxt"><?php echo 'Regular';?></p>
                            
                            <div class="addstoreinput">
                            <input class="form-control" type="number" name="itemprices[]" step="0.01">
                                
                            </div>

                            <div class="addstoreinput"> 
                                <input class="form-control" type="number" name="itemstocks[]">
                            </div>
                        </div>
                    <?php
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
                    }else{ ?>
                        <input type="text" name="itemvariants2[]" value="Regular" hidden>
                    <?php }
                    
                    
                    if (isset($_POST['itemsizes'])) {
                        $j = 0; 
                        foreach ($_POST['itemsizes'] as $itemsize) {
                            $j++; 
                            ?>
                            <input type="text" name="itemsizes2[<?php echo $j; ?>]" value="<?php echo htmlspecialchars($itemsize); ?>" hidden>
                            <?php
                        }
                    }else{ ?>
                        <input type="text" name="itemsizes2[]" value="Regular" hidden>
                    <?php }
                    ?>
                    <input type="text" name="itempic" id="" hidden value="<?php echo $itempic; ?>">
                    <input type="number" name="storeid" id="" value="<?php echo $_POST['storeid'];?>" hidden>
                    <input type="text" name="itemname" id="" value="<?php echo $_POST['itemname'];?>" hidden>
                    <input type="text" name="itemcategory" id="" value="<?php echo $_POST['itemcategory'];?>" hidden>  
                    <input type="text" name="storeitemid" id="" value="<?php echo $_POST['storeitemid'];?>" hidden> 
                    <input type="text" name="itempicbackup" id="" value="<?php echo $_POST['itempicbackup'];?>" hidden> 
                      
            </div>
            <input type="submit" id="submitbtn" class="btn btn-primary submitbtngreen" value="Submit">  

        </div>
        </form>               
    </div>
</body>


</html>