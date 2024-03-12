
<!DOCTYPE html>
<html lang="en">
<body class="storebody storecartbody">
    <?php
        $currentpage='cashier';
        require_once('../include/sidebarstore.php');

    ?>
    <div class="right">
        
        <a class="canceltxt storecartcancel" href="./cancel.php"><?php echo "Cancel order";?></a>
        <?php
        if (!$totalcartcount) {
            ?>
            <div class="nocart">
                <p class="receipttext">You haven't added anything yet in your cart</p>
                <button type="button" class="nocartbtn cancelbtn btn btn-primary cartfooterbtn" onclick="window.location.href='../store/cashier.php'">Browse</button>

            </div>
            <?php
        }?>
        <?php
        if ($totalcartcount) {
            ?>
            <p class="receipttext">Receipt</p>
            <?php
        }?>
        <div class="storemenus cartdiv tablecartstore">
            
            <form action="../database/checkout.php" method="POST">
            <?php
                
                foreach($cartstores AS $cartstore){
                    include("../database/fetchcartdetails.php");
                    ?>
                    <div class="container mt-4">
                <table class="table storecarttable">
                    <thead><p class="cartstorename cartstoretxt"><?php echo $cartstore['cartstorename']; ?></p>
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
                            $cartstoreids = $cartstore['cartstoreid'];
                            
                            
                            include('../database/fetchcartdetails.php');
                            
                        ?>
                        
                        <tr class="item-row" data-itemid="<?php echo $cartdetail['itemid']; ?>" data-itempriceid="<?php echo $cartdetail['itempriceid']; ?>">
                            
                            <input type="number" name="storeid[]" id="" value="<?php echo $cartstoreids;?>" hidden>
                            <input type="number" name="orderid" id="" value="<?php echo $_SESSION['orderid'];?>" hidden>
                            
                            <td class="itemnamecart">
                            <input type="text" class="itemid" name="itemid[]" value="<?php echo $cartdetail['itemid'];?>" id="" hidden>
                                <input type="text" class="itempriceid" name="itempriceid[]" value="<?php echo $cartdetail['itempriceid'];?>" id="" hidden>
                                <p class="cartitemname"><?php echo $cartdetail['itemname'];?></p>
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
                            <td class="total total-price"><span class="totalprice"><?php echo "₱ ".($cartdetail['quantity']*$cartdetail['itemprice']);?></span></td>
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
                <div class="cartfooter cartfooterstorecart">
                <button type="button" class="cancelbtn btn btn-primary cartfooterbtn" onclick="window.location.href='../store/cashier.php'">Order more</button>
                <button type="submit" class="btn btn-primary cartfooterbtn">Checkout</button>
                </div>
                <?php
                }
                ?>
            </form>
        </div>
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
        var stockleft = itemRow.find('.stockleft');

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
                    var data = JSON.parse(response);
                    if (data.price) {
                        if (data.stock) {
                            quantityInput.prop('max', data.stock);
                            if (parseInt(quantityInput.val()) > data.stock) {
                                quantityInput.val(data.stock); 
                                totalPrice.text('₱' + (parseFloat(data.price) * data.stock));
                            }else{
                                totalPrice.text('₱' + (parseFloat(data.price) * quantity));
                            }
                            stockleft.text(data.stock + 'left');
                        }
                        menuprice.text('₱' + data.price);
                       
                    } else {
                        $('.menuprice').text("Price not available");
                    }

                }
            });
        });
    });
});
</script>                
</body>
</html>