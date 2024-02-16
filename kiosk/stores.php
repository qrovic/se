
<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    require_once("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
    require("../database/newcustomer.php");
    
    
?>
<body class="storebody">
    <div class="header">
        <img class="kioskstorelogo" src="../resources/foodparklogo.png" alt="hhee">
        <p class="orderidtxt"><?php echo 'Order Number: ' . $_SESSION['orderid'];?></p>
    </div>
    
    </div>
    <div class="down">
        <div class="kiosksearch">
            <form action="storesearch.php" method="POST"  id="searchforms">
            <input class="searchstores" type="text" name="search" id="" placeholder="Search for stores and menu">
            <input type="text" name=storename hidden value=<?php if (isset($_POST['storename'])){echo $_POST['storename'];}?>>
        </form>
        </div>
        <div class="accountstext" id="storestext">
            <p>All stores</p>
        </div>
        <div class="kioskstores" onclick="examplemodal">
            <?php
            if ($stores) {
                foreach ($stores as $store)     {
                    ?>
                    <form id="" action="menu.php" method="POST" hidden>
                        <input type="text" id="storename" name="storename" value="<?php echo $store['name'];?>" hidden>
                        <input type="text" id="storeid" name="storeid" value="<?php echo $store['id'];?>" hidden>
                        <button type="submit" id="<?php echo $store['name'];?>" style="display:none;"></button>
                    </form>
                    <div class="kioskstore fade-in" onclick="document.getElementById('<?php echo $store['name'];?>').click()">
                    <img class="storelogo" src="<?php echo "../resources/" . $store['pic']; ?>" onerror="this.src='../resources/noimg.png'";>
                        <div class="storename">
                            <p class="accountname"><?php echo $store['name'] ?></p>
                        </div>
                    </div>
                    <?php 
                }
            }
            ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var elements = document.querySelectorAll('.fade-in');

                elements.forEach(function(element, index) {
                    setTimeout(function() {
                        element.classList.add('show');
                    }, index * 100);
                });
            }, 100);
        });
    </script>
    <script>
    document.getElementById('searchforms').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.submit(); 
        }
    });
    </script>
    
</body>
</html>