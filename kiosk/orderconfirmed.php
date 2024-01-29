
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
        
    </div>
    
    <div class="storemenus">
        <p class="receipttext">Thank you for your order</p>
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