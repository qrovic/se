
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
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
        <div class="addstore additem">
        <form action="../store/additem.php" method="POST" enctype="multipart/form-data">
            <div class="storedetails">
                <h2>Store Details</h2>
                
                    <div class="addstoreinput">
                        <label for="">Store ID:</label>
                        <input type="number" name="storeid" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Product Name:</label>
                        <input type="text" name="productname" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Category:</label>
                        <select name="itemcategory" id="">
                            <option value="Drinks">Drinks</option>
                            <option value="Drinks">Meals</option>
                            <option value="Drinks">Snacks</option>
                            <option value="Drinks">Desserts</option>
                            <option value="Drinks">Items</option>  
                        </select>
                    </div>
                    <div class="addstoreinput">
                        <label for="">Item Pic:</label>
                        <input type="file" name ="itempic" src="" alt="">
                    </div>
            </div>
            <div class="ownerdetails" id="ownerdetails">
                <h2>Owner Details</h2>
                    <button type="button" onclick="addVariant()">Add Variant</button>
                    <div class="addvariant" >

                        <label for="">Variant:</label>
                        <input type="text" name="itemvariants[]">
                        <div class="size size-container" id="size-container">

                            <div class="addstoreinput addsizeinput">
                                <label for="">Size:</label>
                                <input type="text" class="samesize" name="itemsizes[]">
                                
                            </div>

                            <div class="addstoreinput">
                                <label for="">Price:</label>
                                <input type="number" name="itemprices[]">
                            </div>

                            <div class="addstoreinput">
                                <label for="">Stock:</label>
                                <input type="number" name="itemstocks[]">
                            </div>

                            <button type="button" class="deletesizebtn" onclick="deleteSize(this)">Delete Size</button>
                        </div>

                        <button type="button" class="addsizebtn" onclick="addSize(this)">Add Size</button>
                        <button type="button" class="deletevariantbtn" onclick="deleteVariant(this)">Delete Variant</button>
                    </div>

                    <input class="btn btn-primary" type="submit" value="Submit">
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

<?php 
$itemsizes = ($_POST['itemsizes']); 
$itemvariants = ($_POST['itemvariants']); 
var_dump($itemvariants);
var_dump($itemsizes); ?>

    <script>
    $(document).on('input', '.addvariant .samesize', function () {
        var newValue = $(this).val();

        var closestSizeDiv = $(this).closest('.size');
        var closestSizeClass = closestSizeDiv.attr('class');
        var lastClass = closestSizeClass.split(' ').pop();

        console.log('Changed input value:', newValue);
        console.log('Last class of the closest div with .size:', lastClass);

        $('.addvariant .' + lastClass + ' .addsizeinput .samesize').val(newValue);

        console.log('Updated value (Size):', $('.addvariant .' + lastClass + ' .addsizeinput .samesize').val());
    });






    function addVariant() {
        var variantContainer = $('.addvariant:first').clone();
        variantContainer.find('input').val('');
        $('.addvariant:last').after(variantContainer);
    }
    function addSize(button) {
        var variantContainers = $('.addvariant');
        variantContainers.each(function() {
            var sizeContainer = $(this).find('.size-container:last');
            var newSize = sizeContainer.clone();

            var index = $(this).find('.size-container').length;
            newSize.addClass('size-container-' + index);

            sizeContainer.after(newSize);
        });
    }


    function deleteSize(button) {
        var sizeElement = $(button).closest('.size');
        var lastClass = sizeElement.attr('class').split(' ').pop();
        alert('Deleting elements with last class: ' + lastClass);        
        $('.' + lastClass).not(sizeElement).remove();
    }






    function deleteVariant(button) {
        
        var variantContainer = $(button).closest('.addvariant');

        variantContainer.remove();
    }



    </script>
    
</html>