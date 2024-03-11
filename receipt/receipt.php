<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="receipt.css">
    <title>Receipt</title>
</head>
<body>
    <?php
        session_start();
        
        include('../database/datafetch.php');
        
        
    ?>
    <div class="receipt-container"></div>
        <div class="receipt-borderline">
            <div class="ticketheader">
                <img class="foodparklogo" src="../resources/foodparklogo.png" alt="Logo">
                <p class="head-number">Order Number:</p>
                
                <div class="number-counter">
                    <p class="ordernumber"><?php echo $_SESSION['orderid'];?></p>
                </div>
                <br>
                <div class="timestamp"></div>
                <div class="date"></div>
            </div>

            <div class="customer-info ">
                <p class="cutomer_number">Order type: <span class="cashiername"><?php echo $_SESSION['type'];?></span><p>
                
            </div>
            
            <?php 
            
            foreach($cartstores AS $cartstore){
                include("../database/fetchcartdetails.php");
                $totalperstore = 0;
                $store=$cartstore['cartstorename'];
                $$store=0;
                ?>
                <div class="Stores">
                    <p class="store">Store</p>
                    <p class="store_name"><?php echo $cartstore['cartstorename'];?></p>
                </div>
                <?php 
                    
                    foreach($cartdetails AS $cartdetail){
                        $cartstoreids = $cartstore['cartstoreid'];
                        
                        
                        include('../database/fetchcartdetails.php');
                        $totalperstore += $cartdetail['quantity'] * $cartdetail['itemprice'];
                        $$store+=$cartdetail['quantity'] * $cartdetail['itemprice'];
                    ?>
                    
                <div class="Items">
                    <p class="item-description"><?php echo $cartdetail['itemname'] . ' '. $cartdetail['itemvariant'] . ' ' . $cartdetail['itemsize'];?></p>
                </div>

                <div class="Item-stats">
                    <p class="quantity"><?php echo $cartdetail['quantity'];?></p>
                    <p class="price"><?php echo "₱ ".$cartdetail['itemprice']?></p>
                    <p class="partial_price"><?php echo "₱ ".($cartdetail['quantity']*$cartdetail['itemprice']);?></p>
                </div>
                
                <?php } ?>
                
                
                
                
                <!--<div class="TPS-stats">
                    <p >Total</p>
                    <p class="total-in-store"><?php echo "₱ ".$totalperstore;?></p>
                </div>-->
                <?php } ?>
                <div class="TPS">
                    <p class="total-per-store">Total per store:</p>
                </div>
                <?php $totalamount=0;?>
                <?php foreach($cartstores AS $cartstore){?>
                    <div class="TPS-stats">
                    <p ><?php echo $cartstore['cartstorename'];?></p>
                    <p class="total-in-store"><?php echo "₱ ".${$cartstore['cartstorename']};?></p>
                    
                    </div>
                    
                   
                <?php 
                
                $totalamount+=${$cartstore['cartstorename']};
                }
                ?>
                <div class="Total-amount">
                    <p class="sum-total">Total Amount: <?php echo "₱ ".$totalamount;?></p>
                </div>
                
                <div class="ticketfooter">
                    <p class="centered">Note: Please proceed to mentioned stalls 
                    and pay the amount needed to complete the transactions. </p>
                </div>

        </div>
    </div>
    <button id="btnPrint" onclick="printPageInBackground()"class="hidden-print">Print</button>
    
    <script>
        // Get current date and time
        var currentDate = new Date();
        var dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var day = dayNames[currentDate.getDay()];
        var month = monthNames[currentDate.getMonth()];
        var date = currentDate.getDate();
        var year = currentDate.getFullYear();
        var hours = currentDate.getHours();
        var minutes = currentDate.getMinutes();
        var seconds = currentDate.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';

        
        hours = hours % 12;
        hours = hours ? hours : 12; 

        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        var timestampStr = day + ', ' + month + ' ' + date + ', ' + year + ', ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;

        document.querySelector(".timestamp").innerHTML = "" + timestampStr;
    </script>
    <script src="receipt.js"></script>
    <script>
        function printPageInBackground() {
            var iframe = document.createElement('iframe');
            iframe.style.display = 'none';
            iframe.src = 'receipt.php';
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