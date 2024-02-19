
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
        <?php echo 'Order No.:' . $_SESSION['orderid'];?>
        <i class='bx bx-shopping-bag'><?php echo $totalcartcount;?></i>
        
    </div>
    <div class="storemenus">
        <p class="orderid"> Order ID: <?php echo $_SESSION['orderid'];?></p>
        <form action="../database/confirmedorder.php" method="POST">
        <div class="container mt-4">
            <table class="table">
                <thead>
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
                    foreach($cartstores AS $cartstore){
                        echo $cartstore['storeid'];  
                    }
                    foreach($cartdetails AS $cartdetail){
                        $cartstoreids = $cartdetail['cartstoreid'];
                        
                        
                        include('../database/datafetch.php');
                    ?>
                    <tr>
                            <input type="number" name="orderid" id="" value="<?php echo $_SESSION['orderid'];?>" hidden>
                            <td>
                                <input type="text" name="itempriceid[]" value="<?php echo $cartdetail['itempriceid'];?>" id="" hidden>
                                <?php echo $cartdetail['itempriceid'];?>
                            </td>
                            <td>
                                <input type="text" name="itemprice[]" value="<?php echo $cartdetail['itemprice'];?>" id="" hidden>
                                <?php echo $cartdetail['itemprice'];?>
                            </td>
                            <td>
                                
                                <select name="itemvariant[]" id="">
                                    
                                    <?php foreach($itemvariants AS $itemvariant){
                                        
                                        ?>
                                        <option value="<?php echo $itemvariant['variant']; ?>" <?php if ($itemvariant['variant'] == $cartdetail['itemvariant']) { echo 'selected'; } ?>><?php echo $itemvariant['variant']; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>                      
                            </td>
                            <td>
                                <select name="itemsize[]" id="">
                                    
                                    <?php foreach($itemsizes AS $itemsize){
                                        
                                        ?>
                                        <option value="<?php echo $itemsize['size']; ?>" <?php if ($itemsize['size'] == $cartdetail['itemsize']) { echo 'selected'; } ?>><?php echo $itemsize['size']; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>     
                            </td>
                            <td>
                                <input type="text" name="quantity[]" value="<?php echo $cartdetail['quantity'];?>" id="">
                                
                            </td>
                            <td><?php echo ($cartdetail['quantity']*$cartdetail['itemprice']);?></td>
                                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    
    

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