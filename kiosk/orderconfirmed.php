
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
    
    <div class="storemenus cancelbody">
        <p class="receipttext">Thank you for your order</p>
        <p class="confirmorderid">Order number: <strong><?php echo $_SESSION['orderid'];?></strong></p><br>
        <p>Please proceed to stalls to pay for your order.</p>
        <p hidden class="countdown-message">Redirecting to store menu in <span id="countdown-number">5</span> seconds...</p>
        <?php 
            session_start();
            session_destroy();
        ?>

    </div>
    <div id="loading-overlay">
        <div id="loading-spinner"></div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("loading-overlay").style.visibility = "visible";
            setTimeout(function () {
                document.getElementById("loading-overlay").style.visibility = "hidden";
            }, 1500);
        });
    </script>

    <script>
        function startCountdown(seconds, redirectUrl) {
            var countdownNumber = document.getElementById('countdown-number');
            var countdownText = document.getElementById('countdown-text');
            var countdownInterval = setInterval(function() {
                seconds--;
                countdownNumber.textContent = seconds;

                if (seconds <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = redirectUrl;
                }
            }, 1000);
        }

        document.addEventListener("DOMContentLoaded", function() {
            startCountdown(5, '../kiosk/stores.php');
        });
    </script>
    <script src="../js/menujs.js"></script>                         
</body>
</html>