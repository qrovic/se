
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
<body class="storequeuebody">
    <div class="storequeueleft">
        <div class="storequeueheader preparing">
            <p class="colleccttxt">Preparing</p>
        </div>
        <div class="" id="preparingdiv">
        </div>
    </div>
    <div class="storequeueright">
        <div class="storequeueheader collect">
            <p class="colleccttxt">Collect</p>
        </div>
        <div class="" id="collectdiv">
            
        </div>
    </div>

    <script src="../js/storequeue.js"></script>


</body>
</html>