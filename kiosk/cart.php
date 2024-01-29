
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
    require_once('../database/datafetch.php');
?>
<body class="storebody">
    <div class="header">
        <img class="kioskstorelogo" src="../resources/foodparklogo.png" alt="hhee" onclick="window.location.href='stores.php'">
        <?php echo 'Order No.:' . $_SESSION['orderid'];?>
        <i class='bx bx-shopping-bag'><?php echo $totalcartcount;?></i>
        
    </div>
    <div class="storemenus">
        <p class="orderid"> Order ID: <?php echo $_SESSION['orderid'];?></p>
        <table>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Variety</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php foreach($cartdetails AS $cartdetail){
            ?>
            <tr>
                <td><?php echo $cartdetail['itename'];?></td>
                <td><?php echo $cartdetail['itemprice'];?></td>
                <td><?php echo $cartdetail['itemvariety'];?></td>
                <td><?php echo $cartdetail['itemsize'];?></td>
                <td><?php echo $cartdetail['quantity'];?></td>
                <td><?php echo ($cartdetail['quantity']*$cartdetail['itemprice']);?></td>
            </tr>
            <?php
            }
            ?>
        </table>
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