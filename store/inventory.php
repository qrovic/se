
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');

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
        <form action="../database/updateitem.php" method="POST" enctype="multipart/form-data">
            <div class="ownerdetails additem2" id="ownerdetails">
                    <input type="number" name="itemid[]" hidden value=<?php echo $_POST['editstoreid'];?>>
                <?php 
                    include('../database/fetchinventory.php');
                    foreach ($edititemvariant as $edititemvariants) {
                    ?>
                        <p class="variantstxt"><?php echo $edititemvariants['variant'];?></p>
                        <hr class="hradditem">
                        <?php
                        foreach ($edititeminventory as $edititeminventories) {
                        if ($edititeminventories['variant'] === $edititemvariants['variant']) {
                        ?>
                            <div class="sizedetails <?php echo $edititemvariants['variant'];?>">
                                <p class="sizetxt"><?php echo $edititeminventories['size'];?></p>
                                <div class="addstoreinput">
                                    <input class="form-control" type="number" name="itemprices[]" step="0.01" value="<?php echo $edititeminventories['price'];?>">
                                </div>
                                <div class="addstoreinput"> 
                                    <input class="form-control" type="number" name="itemstocks[]" value="<?php echo $edititeminventories['stock'];?>">
                                </div>
                                <input type="number" name="itemidpriceid[]" hidden value=<?php echo $edititeminventories['itempriceid'];?>>
                            </div>
                            <?php } ?>
                        <?php
                        } ?>
                    <?php
                    }
                    ?>

                    <?php
                    
                    /*if (isset($_POST['itemprices'])) {
                        $i = 0; 
                        foreach ($_POST['itemprices'] as $itemprices) {
                            $i++; 
                            ?>
                            <input type="text" name="itemvariants2[<?php echo $i; ?>]" value="<?php echo htmlspecialchars($itemprices); ?>" hidden>
                            <?php
                        }
                    }else{ ?>
                        <input type="text" name="itemvariants2[]" value="Regular" hidden>
                    <?php }
                    
                    
                    if (isset($_POST['itemstocks'])) {
                        $j = 0; 
                        foreach ($_POST['itemstocks'] as $itemstocks) {
                            $j++; 
                            ?>
                            <input type="text" name="itemsizes2[<?php echo $j; ?>]" value="<?php echo htmlspecialchars($itemstocks); ?>" hidden>
                            <?php
                        }
                    }else{ ?>
                        <input type="text" name="itemsizes2[]" value="Regular" hidden>
                    <?php }*/
                    ?>
            </div>
            <input type="submit" id="submitbtn" class="btn btn-primary submitbtngreen" value="Update">  

        </div>
        </form>               
    </div>
</body>


</html>