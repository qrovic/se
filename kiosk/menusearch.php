
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
       
?>
<body class="storebody">
    <div class="header">
        <img class="kioskstorelogo" src="../resources/foodparklogo.png" alt="hhee" onclick="window.location.href='stores.php'">
        <?php echo 'Order No.:' . $_SESSION['orderid'];?>
    </div>
    <div class="storeheader">
        <div class="menustorename">
            <p><?php if (isset($_POST['storename'])) { echo $_POST['storename']; } ?></p>
        </div>
        <div class="menusearch">
            <form id="searchform" action="menusearch.php" method="POST">
            <input class="menusearch" type="text" name="itemsearch" id="" placeholder="Search for stores and menu">
            <input type="text" class="" hidden name="storename" value="<?php echo $_POST['storename'];?>">
            </form>
            <div class="categories">
                <ul>
                    <?php if ($categories) {
                        foreach ($categories as $category) {
                        ?>
                        <li><a href="#<?php echo $category['category'];?>" ><?php echo $category['category'];?></a></li>
                        
                        <?php
                        }
                    }
                    ?>
                </ul>
                
            </div>
        </div>
        
    </div>
    <div class="storemenus">
        <div class="storeitems">
            <div class="categoryname">
                <p>We have found <?php echo $filteredstoremenucount; ?> results for "<?php echo $_POST['itemsearch'];?>"</p>
            </div>
            <div class="searchbackground">
                <div class="itemsdiv">
                    
                    <?php
                    foreach ($filteredstoremenu as $storemenusearch) {
                    ?>
                    
                        <div class="storeitem">
                            <div class="itemdetails">
                                <p class="itemname"><?php echo $storemenusearch['item_name'] ?></p>
                                <p class="itemprice">from ₱<?php echo rand(50, 199); ?></p>
                            </div>
                            <img class="itemlogo" src="<?php echo "../resources/" . $storemenusearch['item_pic']; ?>" alt="Store Logo">
                        </div>
                    
                    <?php
                    }
                    ?>
                </div>
            </div>
            
            <?php
            if ($categories) {
                foreach ($categories as $category) {
                    $item = $category['category'];
                    ?>
                    <div class="categoryitem">
                    
                        <section id="<?php echo $category['category']; ?>"></section>
                        <div class="categoryname">
                            <p><?php echo $category['category']; ?></p>
                        </div>
                        <div class="itemsdiv">
                        <?php
                        foreach ($$item as $nope) {
                        ?>
                            <div class="storeitem">
                                <div class="itemdetails">
                                    <p class="itemname"><?php echo $nope['item_name'] ?></p>
                                    <p class="itemprice">from ₱<?php echo rand(50, 199); ?></p>
                                </div>
                                <img class="itemlogo" src="<?php echo "../resources/" . $nope['item_pic']; ?>" alt="Store Logo">
                            </div>
                        
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                <?php
                }
            }
            ?>
        </div>
    </div>

</body>
<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        //remove active
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.classList.remove('active');
        });

        //add active
        this.classList.add('active');

        //scroll to into
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

</script>
<script>
    document.getElementById('searchform').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); 
            this.submit(); 
        }
    });
</script>
</html>