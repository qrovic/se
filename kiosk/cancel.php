
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
        <p class="receipttext">ORDER NUMBER: <?php echo $_SESSION['orderid'];?> </p>
        <p class="receipttext iscancelled">HAS BEEN CANCELLED</p>
        <p class="countdown-message">Redirecting to store menu in <span id="countdown-number">5</span> seconds...</p>


    </div>
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
            startCountdown(5, '../database/cancel.php');
        });
    </script>
    <script src="../js/menujs.js"></script>                         
</body>
</html>