
<!DOCTYPE html>
<html lang="en">

<body class="storebody cashierbody">
    
    <?php
        $currentpage='cashier';
        require_once('../include/sidebarstore.php');

    ?>
    <?php
        if ($_SESSION['role']){
            if ($_SESSION['role'] != 'Cashier'){
                header('Location: ../store/orderspaid.php');
            }
        }
    ?>
    
    <div class="right"> 
        <div class="header headercashier">
            <div class="cartbag" onclick="window.location.href='../store/storecart.php'">
                <div class="bx-shopping-bag-container cashierbag">
                    <i class='bx bx-shopping-bag shoppingbag' style='color: black;'></i>
                    <div class="cart-count shoppingbagcircle" style='background-color: black;'>
                        <span class="cart-count-number cartcountnumber" id="cartCount" style='color: white;'></span>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="storeheader">
       
        <div class="menusearch cashiersearch">
        <form action="cashiersearch.php" method="POST" id="searchforms">
            <input class="menusearch" type="text" name="itemsearch" id="" placeholder="Search for stores and menu">
            <input type="text" class="" hidden name="storename" value="<?php echo $_SESSION['storename'];?>">
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
        <div class="storeitems cashieritems">
            <?php
            if ($categories) {
                foreach ($categories as $category) {
                    $item = $category['category'];
                    ?>
                    <div class="categoryitem">
                        
                        <section id="<?php echo $category['category']; ?>">
                        <div class="categoryname">
                            <p><?php echo $category['category']; ?></p>
                        </div>
                        <div class="itemsdiv">
                        <?php
                        foreach ($$item as $nope) {
                        
                        ?>  
                            <div class="modal fade" id="<?php echo str_replace(' ', '', $nope['item_name']); ?>" data-currentmenuid="<?php echo $nope['item_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog menumodal">
                                    <div class="modal-content menumodalcontent">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><p class="menuitemname"><?php echo $nope['item_name'];?></p></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body modalbody">
                                    <script>console.log('itemname')</script>
                                            <?php 
                                                include('../database/fetchmenudetails.php');
                                            ?>
                                            <div class="menumodalbody">
                                            <form action="../database/addtocart.php" METHOD="POST" class="addToCartForm" onsubmit="submitForm(event, this)">
                                                <img class="menumodalpic" src="../resources/<?php echo $nope['item_pic'];?>" alt="">
                                                <div class="menudetails">
                                                    
                                                    <header>
                                                    <p class="menuprice" value=""><?php echo "₱".$lowestprice;?></p>
                                                    </header>
                                                </div>
                                                <div class="menuvariation">
                                                    <p class="choosevariant">Choose a variant:</p>
                                                    <?php 
                                                    foreach($menuvariant as $menuvariants){
                                                        ?>
                                                        <div class="radioholder">
                                                        <input type="radio" name="menuvariation" id="variant_<?php echo $menuvariants['menuvariety'].$nope['item_id'];?>" value="<?php echo $menuvariants['menuvariety'];?>">
                                                        <label class="itemsizelabel" for="variant_<?php echo $menuvariants['menuvariety'].$nope['item_id'];?>"><?php echo $menuvariants['menuvariety'];?></label>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <br>
                                                <div class="menusize">
                                                    <p class="choosevariant">Choose a size:</p>
                                                    <?php 
                                                    foreach($menusize as $menusizes){
                                                        ?>
                                                        <div class="radioholder">
                                                        <input type="radio" name="menusize" id="size_<?php echo $menusizes['menusize'].$nope['item_id'];?>" value="<?php echo $menusizes['menusize'];?>">
                                                        <label class="itemsizelabel" for="size_<?php echo $menusizes['menusize'].$nope['item_id'];?>"><?php echo $menusizes['menusize'];?></label>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                            
                                                
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <div class="modalfooter">
                                            <div class="stockdiv">
                                                <div class="quantitydiv">
                                                        <button class="quantitybutton" onclick="decreaseQuantity()" type="button"><p class="quantitybtn">-</p></button>
                                                        <input type="text" readonly name="quantity" class="quantityInput" id="quantityInput" value="1" max="1">
                                                        <button class="quantitybutton" onclick="increaseQuantity()" type="button"><p class="quantitybtn">+</p></button>
                                                    </div>
                                                    <p class="menustock"></p>
                                            </div>
                                            <input type="number" name="menuid" hidden value="<?php echo $nope['item_id'];?>">
                                            <button disabled type="submit" class="btn btn-primary addtocartbtn" id="addtocartbutton">Add to cart</button>

                                        </div>
                                        
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <div class="storeitem fade-in-left" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '', $nope['item_name']); ?>">
                                <div class="itemdetails">
                                    <p class="itemname"><?php echo $nope['item_name'] ?></p>
                                    <p class="itemprice">from ₱<?php echo $lowestprice;?></p>
                                </div>
                                <img class="itemlogo" src="<?php echo "../resources/" . $nope['item_pic']; ?>" alt="Store Logo">
                            
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                    </section>
                <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<script src="../js/menujs.js"></script>                     
</body>
</html>