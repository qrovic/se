
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
        <a class="canceltxt" href="#" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Cancel order</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel this order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="./cancel.php" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
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
        <p class="receipttext">Order Overview</p>
        <?php
    }?>
    <div class="storemenus cartdiv">
        
        <form id="checkout" action="../database/checkout.php" method="POST">
        <?php
            
            foreach($cartstores AS $cartstore){
                include("../database/fetchcartdetails.php");
                ?>
                <div class="container mt-4">
            <table class="table">
                <thead><p class="cartstorename"><?php echo $cartstore['cartstorename']; ?></p>
                    <tr>
                        <th>Item</th>
                        <th style="text-align: center;">Size</th>
                        <th style="text-align: center;">Variety</th>
                        <th style="text-align: center;">Price</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: center;">Total</th>
                        <th style="text-align: center;"></th>
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
                        
                        <td class="itemnamecart" style="max-width: 200px; overflow: hidden; min-width: 200px; text-overflow: ellipsis; white-space: nowrap;">
                        <input type="text" class="itemid" name="itemid[]" value="<?php echo $cartdetail['itemid'];?>" id="" hidden>
                            <input type="text" class="itempriceid" name="itempriceid[]" value="<?php echo $cartdetail['itempriceid'];?>" id="" hidden>
                            <p class="cartitemname"><?php echo $cartdetail['itemname'];?></p>
                        </td>
                        
                        <td class="itemvariant" style="max-width: 50px; overflow: hidden; min-width: 50px; text-overflow: ellipsis; white-space: nowrap;">    
                            
                            <select name="itemvariant[]" class="item-variant" id="">
                                
                                <?php foreach($itemvariants AS $itemvariant){
                                    
                                    ?>
                                    <option value="<?php echo $itemvariant['variant']; ?>" <?php if ($itemvariant['variant'] == $cartdetail['itemvariant']) { echo 'selected'; } ?>><?php echo $itemvariant['variant']; ?></option>
                                    <?php
                                }
                                ?> 
                            </select>                 
                        </td>
                        <td class="cartitemsize" style="align-items:center; text-align:center; max-width: 50px; overflow: hidden; min-width: 50px; text-overflow: ellipsis; white-space: nowrap;">
                            <select name="itemsize[]" class="item-size" id="" style="text-align: center;">
                                
                                <?php foreach($itemsizes AS $itemsize){
                                    
                                    ?>
                                    <option value="<?php echo $itemsize['size']; ?>" <?php if ($itemsize['size'] == $cartdetail['itemsize']) { echo 'selected'; } ?>><?php echo $itemsize['size']; ?></option>
                                    <?php
                                }
                                ?> 
                            </select>     
                        </td>
                        <td class="itemprice" style="text-align: center;">
                            <span style="text-align: center;" class="itemmenuprice"><?php echo "₱" . $cartdetail['itemprice'];?></span>
                            <input type="text" name="itemprice[]" value="<?php echo $cartdetail['itemprice'];?>" id="" hidden>
                            
                        </td>
                        <td class="itemquantity" style="text-align: center;">
                        
                            <!--<button class="quantitybutton" onclick="decreaseQuantity(this)" type="button"><p class="quantitybtn">-</p></button>-->
                            <input type="text" name="quantity[]" class="quantity" value="<?php echo $cartdetail['quantity'];?>" style="max-width: 20px; overflow: hidden; min-width: 20px; text-overflow: ellipsis; white-space: nowrap; text-align:center;">
                            <!--<button class="quantitybutton" onclick="increaseQuantity(this)" type="button"><p class="quantitybtn">+</p></button>-->
                
                        </td>
                        <td class="total total-price" style="text-align: center;"><span style="text-align: center;" class="totalprice"><?php echo "₱ ".($cartdetail['quantity']*$cartdetail['itemprice']);?></span></td>
                        <td class="notranktxt" style="text-align: center;">
                            <button type="button" data-bs-toggle="modal" style="border: none; background: none; padding: 0; cursor: pointer;" data-bs-target="#deleteModal<?php echo $cartdetail['itempriceid'] . $_SESSION['orderid']; ?>">
                            <i class="bx bxs-x-circle text-danger fs-4"></i>


                            </button>
                        </td>
                    </tr>
                    <div class="modal fade" id="deleteModal<?php echo $cartdetail['itempriceid'] . $_SESSION['orderid']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="cartdeletemodal modal-dialog modal-dialog-centered" style="max-width: 300px;">
                            <div class="modal-content cartdelete">
                                <div class="modal-body">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="bx bxs-trash-alt text-danger fs-4"></i>
                                        <h5 class="modal-title ms-2" id="deleteModalLabel">Confirm Delete</h5>
                                    </div>
                                    <p class="text-center mt-3">Are you sure you want to delete this item?</p>
                                </div>
                                <div class="cartfooterdelete modal-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" onclick="deleteCartItem('<?php echo $cartdetail['itempriceid']; ?>')">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>


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
            </form>
            <div class="cartfooter">
                
            <button type="button" class="cancelbtn btn btn-primary cartfooterbtn" onclick="window.location.href='../kiosk/menu.php'">Order more</button>
            <button class="btn btn-primary cartfooterbtn" type="submit" onclick="printPageInBackground(); setTimeout(function() { document.getElementById('checkout').submit(); }, 5000);">Checkout</button>
            </div>
            <?php
            }
            ?>
        
        
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
<script>
    function deleteCartItem(itempriceid) {
    $.ajax({
        url: '../database/deletecart.php',
        method: 'POST',
        data: {
            deletecartitempriceid: itempriceid,
            deletecartorderid: '<?php echo $_SESSION['orderid']; ?>'
        },
        success: function(response) {
            // Check if deletion was successful
            if (response == 'success') {
                location.reload();
            }
        }
    });
}

</script>
<script>
        function printPageInBackground() {
            var iframe = document.createElement('iframe');
            iframe.style.display = 'none';
            iframe.src = '../receipt/receipt.php';
            document.body.appendChild(iframe);

            iframe.onload = function() {
                iframe.contentWindow.print();
                setTimeout(function() {
                    document.body.removeChild(iframe);
                }, 1000);
            };
        }
    </script>
</body>
</html>