
<!DOCTYPE html>
<html lang="en">
<body>
    <?php
        $currentpage='menus';
        require_once('../include/sidebarstore.php');
    ?>
    <div class="right">
        <div class="">
            <form class="addstore" action="../store/additem2.php" method="POST" enctype="multipart/form-data">
            <div class="storedetails additemstore">
            
                <p class="itemdetailstxt">Item Details</p>
                    <div class="addstoreinput additeminput">
                        <input type="number" name="storeid" id="" value=<?php echo $_SESSION['storestoreid'];?> hidden>
                    </div>
                    <div class="addacclogo additemlogo" style="background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), background-position: center; background-size: cover;">
                        <label for="file" class="btn uploadbtn"><i class='bx bx-upload'></i>Upload</label>
                        <input id="file" hidden name="itempic" type="file" onchange="previewimg(this);">
                    </div>
                    
                    <div class="addstoreinput additeminput">
                        <label class="form-label" for="itemname">Product Name:</label>
                        <input class="form-control" type="text" id="itemname" name="itemname" id="">
                    </div>
                    <div class="addstoreinput additeminput">
                        <label class="form-label" for="itemcategory">Category:</label>
                        <select class="form-control" name="itemcategory" id="itemcategory">
                            <option value="Drinks">Drinks</option>
                            <option value="Meals">Meals</option>
                            <option value="Snacks">Snacks</option>
                            <option value="Desserts">Desserts</option>
                            <option value="Combos">Combos</option>  
                        </select>
                    </div>
                    
            </div>
            <div class="ownerdetails additemvariant" id="ownerdetails">
            
                <p class="itemdetailstxt">Variations and Sizing</p>

                <label class="form-label" for="categories">Select Variation</label><br>
                <div id="varietiesContainer">
                    <div class="form-check checkbox">
                        <input class="form-check-input" type="checkbox" name="itemvariants[]" value="hot" id="hotCheckbox">
                        <label class="form-check-label" for="hotCheckbox">Hot</label>
                    </div>
                    <div class="form-check checkbox">
                        <input class="form-check-input" type="checkbox" name="itemvariants[]" value="cold" id="coldCheckbox">
                        <label class="form-check-label" for="coldCheckbox">Cold</label>
                    </div>
                </div>

                <div id="newVarietyContainer" style="display: none;">
                    <input type="text" id="newVarietyInput" class="form-control" placeholder="Add new variety and press Enter">
                </div>
                <button type="button" id="addVarietyBtn" class="btn btn-primary addsizebtngreen">+ Add</button>
                <br>

                <div class="sizediv">
                    <label class="form-label" for="size">Select size</label><br>
                    <div id="sizesContainer">
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" name="itemsizes[]" value="Small" id="smallCheckbox">
                            <label class="form-check-label" for="smallCheckbox">Small</label>
                        </div>
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" name="itemsizes[]" value="Medium" id="mediumCheckbox">
                            <label class="form-check-label" for="mediumCheckbox">Medium</label>
                        </div>
                    </div>

                    <div id="newSizeContainer" style="display: none;">
                        <input type="text" id="newSizeInput" class="form-control" placeholder="Add new size and press Enter">
                    </div>
                    <button type="button" id="addSizeBtn" class="btn btn-primary addsizebtngreen">+ Add</button>
                    <div class="submitbtndiv">
                    <input type="submit" id="submitbtn" class="btn btn-primary addsizebtngreensubmit" value="Set Variation Info">
                </div>
                </div>
               
            </div>
            </form>  
        </div>
                   
    </div>
<?php
//var_dump($_POST['storeid']);
//var_dump($_POST['itemvariants']);
//var_dump($_POST['itemsizes']);
?>


   
</body>

<script>
        var sizesContainer = document.getElementById('sizesContainer');
        var newSizeContainer = document.getElementById('newSizeContainer');
        var newSizeInput = document.getElementById('newSizeInput');
        var addSizeBtn = document.getElementById('addSizeBtn');
   

        addSizeBtn.addEventListener('click', function() {
            newSizeContainer.style.display = 'block';
            newSizeInput.focus();
        });

        newSizeInput.addEventListener('keyup', function(event) {
            if (event.keyCode === 13) {
                var newSizeCheckbox = document.createElement('input');
                newSizeCheckbox.type = 'checkbox';
                newSizeCheckbox.name = 'itemsizes[]';
                newSizeCheckbox.value = newSizeInput.value;
                newSizeCheckbox.classList.add('form-check-input');

                var newSizeLabel = document.createElement('label');
                newSizeLabel.innerHTML = ' ' + newSizeInput.value;

                var sizeOption = document.createElement('div');
                sizeOption.className = 'form-check checkbox';
                sizeOption.appendChild(newSizeCheckbox);
                sizeOption.appendChild(newSizeLabel);

                sizesContainer.appendChild(sizeOption);

                newSizeInput.value = '';
                newSizeContainer.style.display = 'none';
            }
        });


        var varietiesContainer = document.getElementById('varietiesContainer');
        var newVarietyContainer = document.getElementById('newVarietyContainer');
        var newVarietyInput = document.getElementById('newVarietyInput');
        var addVarietyBtn = document.getElementById('addVarietyBtn');

        addVarietyBtn.addEventListener('click', function() {
            newVarietyContainer.style.display = 'block';
            newVarietyInput.focus();
        });

        newVarietyInput.addEventListener('keyup', function(event) {
            if (event.keyCode === 13) {
                var newVarietyCheckbox = document.createElement('input');
                newVarietyCheckbox.type = 'checkbox';
                newVarietyCheckbox.name = 'itemvariants[]';
                newVarietyCheckbox.value = newVarietyInput.value;
                newVarietyCheckbox.classList.add('form-check-input');

                var newVarietyLabel = document.createElement('label');
                newVarietyLabel.innerHTML = ' ' + newVarietyInput.value;

                var varietyOption = document.createElement('div');
                varietyOption.className = 'form-check checkbox';
                varietyOption.appendChild(newVarietyCheckbox);
                varietyOption.appendChild(newVarietyLabel);

                varietiesContainer.appendChild(varietyOption);

                newVarietyInput.value = '';
                newVarietyContainer.style.display = 'none';
            }
        });

    </script>



    <script>
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && e.target.tagName.toLowerCase() !== 'textarea' && e.target.type !== 'submit') {
                e.preventDefault();
            }
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var previewContainers = document.querySelectorAll('.addacclogo');
        previewContainers.forEach(function (previewContainer) {
            previewContainer.dataset.defaultBg = getComputedStyle(previewContainer).backgroundImage;
        });
    });

    function previewimg(input) {
        var fileInput = input;
        var previewContainers = document.querySelectorAll('.addacclogo');
        
        previewContainers.forEach(function (previewContainer) {
            var defaultBg = previewContainer.dataset.defaultBg;
            var file = fileInput.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.style.backgroundImage = "linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url('" + e.target.result + "')";
                    previewContainer.style.backgroundPosition = "center";
                    previewContainer.style.backgroundSize = "cover";
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.backgroundImage = defaultBg; 
            }
        });
    }
</script>



</html>