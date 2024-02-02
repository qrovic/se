
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
    <div class="storemenus cartdiv">
        
        <form action="../database/checkout.php" method="POST">
        <?php
            
            foreach($cartstores AS $cartstore){
                include('../database/datafetch.php');
                ?>
                <div class="container mt-4">
            <table class="table">
                <thead><p class="cartstorename"><?php echo $cartstore['cartstorename']; ?></p>
                    <tr>
                        <th>Item</th>
                        <th>Size</th>
                        <th>Variety</th>
                        <th>Price</th>
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
                    
                    <tr class="item-row" data-itemid="<?php echo $cartdetail['itemid']; ?>" data-itempriceid="<?php echo $cartdetail['itempriceid']; ?>">
                        
                        <input type="number" name="storeid[]" id="" value="<?php echo $cartstoreids;?>" hidden>
                        <input type="number" name="orderid" id="" value="<?php echo $_SESSION['orderid'];?>" hidden>
                        
                        <td class="itemnamecart">
                        <input type="text" class="itemid" name="itemid[]" value="<?php echo $cartdetail['itemid'];?>" id="" hidden>
                            <input type="text" class="itempriceid" name="itempriceid[]" value="<?php echo $cartdetail['itempriceid'];?>" id="" hidden>
                            <?php echo $cartdetail['itemname'];?>
                        </td>
                        
                        <td class="itemvariant">    
                            
                            <select name="itemvariant[]" class="item-variant" id="">
                                
                                <?php foreach($itemvariants AS $itemvariant){
                                    
                                    ?>
                                    <option value="<?php echo $itemvariant['variant']; ?>" <?php if ($itemvariant['variant'] == $cartdetail['itemvariant']) { echo 'selected'; } ?>><?php echo $itemvariant['variant']; ?></option>
                                    <?php
                                }
                                ?> 
                            </select>                 
                        </td>
                        <td class="cartitemsize">
                            <select name="itemsize[]" class="item-size" id="">
                                
                                <?php foreach($itemsizes AS $itemsize){
                                    
                                    ?>
                                    <option value="<?php echo $itemsize['size']; ?>" <?php if ($itemsize['size'] == $cartdetail['itemsize']) { echo 'selected'; } ?>><?php echo $itemsize['size']; ?></option>
                                    <?php
                                }
                                ?> 
                            </select>     
                        </td>
                        <td class="itemprice">
                            <span class="itemmenuprice"><?php echo "₱" . $cartdetail['itemprice'];?></span>
                            <input type="text" name="itemprice[]" value="<?php echo $cartdetail['itemprice'];?>" id="" hidden>
                            
                        </td>
                        <td class="itemquantity">
                        
                            <!--<button class="quantitybutton" onclick="decreaseQuantity(this)" type="button"><p class="quantitybtn">-</p></button>-->
                            <input type="text" name="quantity[]" class="quantity" value="<?php echo $cartdetail['quantity'];?>">
                            <!--<button class="quantitybutton" onclick="increaseQuantity(this)" type="button"><p class="quantitybtn">+</p></button>-->
                
                        </td>
                        <td class="total total-price"><span class="totalprice"><?php echo "₱".($cartdetail['quantity']*$cartdetail['itemprice']);?></span></td>
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
    <script src="../js/menujs.js"></script>     
    <script>
        /*function increaseQuantity(element) {
        var quantityInput = element.previousElementSibling;
        var currentQuantity = parseInt(quantityInput.value, 10);
        quantityInput.value = currentQuantity + 1;
        updateQuantityValue(quantityInput);
    }

    function decreaseQuantity(element) {
        var quantityInput = element.nextElementSibling;
        var currentQuantity = parseInt(quantityInput.value, 10);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            updateQuantityValue(quantityInput);
        }
    }

    function updateQuantityValue(quantityInput) {
        // Add any additional logic you need before updating the value attribute
        var newValue = quantityInput.value;

        // Update the value attribute
        quantityInput.setAttribute('value', newValue);
    }*/



    </script>    
    <script>
    $(document).ready(function() {
    $('.item-row').each(function(index, element) {
        var itemRow = $(this);
        var itemVariant = itemRow.find('.item-variant');
        var itemSize = itemRow.find('.item-size');
        var totalPrice = itemRow.find('.totalprice');
        var selectedMenu = itemRow.find('.itemid');
        var quantityInput = itemRow.find('.quantity');
        var menuprice = itemRow.find('.itemmenuprice');

        itemVariant.add(itemSize).add(quantityInput).change(function() {
            var selectedVariety = itemVariant.val();
            var selectedSize = itemSize.val();
            var selectedMenuId = selectedMenu.val();
            var quantity = quantityInput.val();
            var updatedmenuprice = menuprice.val();

            $.ajax({
                url: '../database/fetchmenudetails.php',
                method: 'POST',
                data: {
                    variety: selectedVariety,
                    size: selectedSize,
                    menuid: selectedMenuId,
                    quantity: quantity,
                    menuprice: updatedmenuprice
                },
                success: function(response) {
                    menuprice.text('₱' + response),
                    totalPrice.text('₱' + (parseFloat(response) * quantity));
                }
            });
        });
    });
});
</script>                
</body>
</html>