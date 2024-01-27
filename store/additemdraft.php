
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
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
    <div class="right">
        <h1>Add Store</h1>
        <div class="addstore">
            <div class="storedetails">
                <h2>Store Details</h2>
                <form action="../database/additemdraft.php" method="POST" enctype="multipart/form-data">
                    <div class="addstoreinput">
                        <label for="">Store ID:</label>
                        <select name="storeid" id="">
                            <?php foreach ($allstores as $allstore){
                                ?>
                                <option value="<?php echo $allstore['id'];?>"><?php echo $allstore['name'];?></option>
                                <?php
                                }
                                ?>
                        </select>
                    </div>
                    <div class="addstoreinput">
                        <label for="">Item Name:</label>
                        <input type="text" name="itemname" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Category:</label>
                        <select name="itemcategory" id="">
                            <option value="Drinks">Drinks</option>
                            <option value="Meals">Meals</option>
                            <option value="Snacks">Snacks</option>
                            <option value="Desserts">Desserts</option>
                            <option value="Items">Items</option>  
                        </select>
                    </div>
                    <div class="addstoreinput">
                        <label for="">Item Pic:</label>
                        <input type="file" name ="itempic" src="" alt="">
                    </div>
                    <input class="btn btn-primary" type="submit" value="submit">
                </form>
            </div>
           

                

                    
            
        </div>
        
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
                
            </div>
                </form>
            </div>
        </div>
    </div>

   
</body>

<script>
    var sizeContainerTemplate = document.querySelector('.size-container').cloneNode(true);

    function addVariant() {
        var variantTemplate = document.querySelector('.addvariant');
        var clone = variantTemplate.cloneNode(true);
        clone.removeAttribute('hidden');

        var sizeContainer = clone.querySelector('.size-container');
        sizeContainer.removeAttribute('hidden');

        document.getElementById('ownerdetails').appendChild(clone);
    }

    function addSize(button) {
        var parentContainer = button.parentNode;
        var clone = sizeContainerTemplate.cloneNode(true);
        clone.removeAttribute('hidden');

        parentContainer.appendChild(clone);
    }
</script>


</html>