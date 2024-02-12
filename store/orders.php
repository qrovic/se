
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');

    session_start();
    if(!isset($_SESSION['$storestoreid'])){
        $_SESSION['storestoreid']=38;
    }
    $storestoreid=38;

?>
<body>
    <div class="left">
        <div class="options">
            <ul class="options">
                <li class="options">
                    <a href="overview.php">Overview</a>
                </li>
                <li class="options">
                    <a href="overview.php">Accounts</a>
                </li>
                <li class="options">
                    <a href="overview.php">Sales</a>
                </li>
                <li class="options">
                    <a href="overview.php">Settings</a>
                </li>
                <li class="options logout">
                    <a href="overview.php">Logout</a>
                </li>
            </ul>
        </div>
        
    </div>
    <div class="right storeright">
        <div class="notif">
            <audio id="notifsound" src="../resources/notif.mp3"></audio>
            <div class="toast align-items-center text-white bg-primary border-0 position-fixed top-0 end-0" style="margin-top: 1.5rem !important; margin-right: 1.5rem !important;" role="alert" aria-live="assertive" aria-atomic="true" id="myToast">
                <div class="d-flex">
                    <div class="toast-body">
                        Incoming order: ORDER #<span class="neworderid"></span>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <div class="ordersnumdiv">
            <div class="orderserved">
                <p class="orderservednum"></p>
                <div class="orderservedtxt">
                    <p class="ordertxt">PAID</p>
                    <p class="ordertxt">ORDERS</p>
                </div>
                
            </div>
            <div class="orderpending">
                <p class="orderpeningnum"></p>
                <div class="orderpendingtxt">
                    <p class="ordertxt">UNPAID</p>
                    <p class="ordertxt">ORDERS</p>
                </div>
                
            </div>
        </div>
        
        <p class="orderqueuetxt">Pending Payment</p>
        <div class="container mt-4">
            <table class="table tablestore table-max-height">
                <thead>
                    <tr>
                        <th>Order number</th>
                        <th>Time</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-max-height" id="orderTableBody">
                   
                </tbody>
            </table>
        </div>
    </div>
    
    
    <div id="modalshere"></div>
    <script src="../js/stores.js"></script>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                var storestoreid = <?php echo $storestoreid; ?>;

                $.ajax({
                    type: 'POST',
                    url: '../database/fetchordersdetails.php',
                    data: { storestoreid: storestoreid },
                    dataType: 'json',
                    success: function(response) {
                        $('.orderpeningnum').text(response.ordertopaycount);
                        $('.orderservednum').text(response.orderpaidcount);
                        $('.neworderid').text(response.neworderid);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error);
                    }
                });
            }, 1000);
        });
    </script>


</body>
</html>