
<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    if (isset($_POST['storeid'])){
        $_SESSION['storeid']=$_POST['storeid'];
        $_SESSION['storename']=$_POST['storename'];
    }
    require_once ("../include/head.php");
    require_once('../include/js.php');
    include('../database/datafetch.php');
    
    
?>
<body class="storebody">
    <div class="header">
        <img class="kioskstorelogo" src="../resources/foodparklogo.png" alt="hhee" onclick="window.location.href='stores.php'">
        <a class="canceltxt" href="./cancel.php"><?php echo "Cancel order";?></a>
    </div>
    <?php
    if ($totalcartcount<1) {
        ?>
        <div class="nocart">
            <p class="receipttext">You haven't added anything yet in your cart</p>
            <button type="button" class="nocartbtn cancelbtn btn btn-primary cartfooterbtn" onclick="window.location.href='../kiosk/menu.php'">Browse</button>

        </div>
        <?php
    }?>
    <?php
    if ($totalcartcount>0) {
        ?>
        <p class="receipttext">Receipt</p>
        <?php
    }?>
    <div class="storemenus">
        
        <form action="../database/confirmedorder.php" method="POST">
        <?php
            
            foreach($cartstores AS $cartstore){
                include('../database/datafetch.php');
                ?>
                <div class="container mt-4">
            <table class="table">
                <thead><p class="cartstorename"><?php echo $cartstore['cartstorename']; ?></p>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Variety</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    foreach($cartdetails AS $cartdetail){
                        $cartstoreids = $cartdetail['cartstoreid'];
                        
                        
                        include('../database/datafetch.php');
                        
                    ?>
                    
                    <tr>    <input type="number" name="storeid[]" id="" value="<?php echo $cartstoreids;?>" hidden>
                            <input type="number" name="orderid" id="" value="<?php echo $_SESSION['orderid'];?>" hidden>
                            
                            <td class="itemnamecart">
                                <input type="text" name="itempriceid[]" value="<?php echo $cartdetail['itempriceid'];?>" id="" hidden>
                                <?php echo $cartdetail['itemname'];?>
                            </td>
                            <td class="itemprice">
                                <input type="text" name="itemprice[]" value="<?php echo $cartdetail['itemprice'];?>" id="" hidden>
                                <?php echo "₱" . $cartdetail['itemprice'];?>
                            </td>
                            <td class="itemvariant">
                                
                                <select name="itemvariant[]" id="">
                                    
                                    <?php foreach($itemvariants AS $itemvariant){
                                        
                                        ?>
                                        <option value="<?php echo $itemvariant['variant']; ?>" <?php if ($itemvariant['variant'] == $cartdetail['itemvariant']) { echo 'selected'; } ?>><?php echo $itemvariant['variant']; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>                 
                            </td>
                            <td class="cartitemsize">
                                <select name="itemsize[]" id="">
                                    
                                    <?php foreach($itemsizes AS $itemsize){
                                        
                                        ?>
                                        <option value="<?php echo $itemsize['size']; ?>" <?php if ($itemsize['size'] == $cartdetail['itemsize']) { echo 'selected'; } ?>><?php echo $itemsize['size']; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>     
                            </td>
                            <td class="itemquantity">
                                <input type="text" name="quantity[]" value="<?php echo $cartdetail['quantity'];?>" id="">
                                
                            </td>
                            <td class="total"><?php echo "₱".($cartdetail['quantity']*$cartdetail['itemprice']);?></td>
                                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
            }
        ?>  
            <?php
            if ($totalcartcount>0) {
            ?>
            <div class="cartfooter">
            <button type="button" class="cancelbtn btn btn-primary cartfooterbtn" onclick="window.location.href='../kiosk/menu.php'">Order more</button>
            <button type="submit" class="btn btn-primary cartfooterbtn">Checkout</button>
            </div>
            <?php
            }
            ?>
        </form>
    </div>
    <div id="loading-overlay">
        <div id="loading-spinner"></div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("loading-overlay").style.visibility = "visible";
            setTimeout(function () {
                document.getElementById("loading-overlay").style.visibility = "hidden";
            }, 2000);
        });
    </script>

    <script>
    
    function increaseQuantity() {
        var quantityInputs = document.getElementsByClassName('quantityInput');
        for (var i = 0; i < quantityInputs.length; i++) {
            var currentQuantity = parseInt(quantityInputs[i].value, 10);
            quantityInputs[i].value = currentQuantity + 1;
        }
    }

    function decreaseQuantity() {
        var quantityInputs = document.getElementsByClassName('quantityInput');
        for (var i = 0; i < quantityInputs.length; i++) {
            var currentQuantity = parseInt(quantityInputs[i].value, 10);

            if (currentQuantity > 1) {
                quantityInputs[i].value = currentQuantity - 1;
            }
        }
    }
</script>

    <script src="../js/menujs.js"></script>                         
</body>
</html>