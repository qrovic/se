
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php')
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
        <form action="../store/additem2.php" method="POST" enctype="multipart/form-data">
            <div class="storedetails">
                <h2>Store Details</h2>
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
                        <label for="">Product Name:</label>
                        <input type="text" name="itemname" id="">
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
                        <label for="">item Pic:</label>
                        <input type="file" name ="itempic" src="" alt="">
                    </div>
            </div>
            <div class="ownerdetails" id="ownerdetails">
                <h2>Variations and sizing</h2>

            
                    <label for="categories">Select Variation</label><br>
                    <div id="varietiesContainer">
                        <input type="checkbox" name="itemvariants[]" value="hot"> Hot<br>
                        <input type="checkbox" name="itemvariants[]" value="cold"> Cold<br>
                    </div>

                    <div id="newVarietyContainer" style="display: none;">
                        <input type="text" id="newVarietyInput" placeholder="Add new variety and press Enter">
                    </div>
                    <button type="button" id="addVarietyBtn">Add Variety</button>
                    <br>
                    <input type="checkbox"  id="toggleSizeDiv" checked> Show/Hide SizeDiv
                    <div class="sizediv">
                        <label for="size">Select size</label><br>
                        <div id="sizesContainer">
                            <input type="checkbox" name="itemsizes[]" value="Small"> smaill<br>
                            <input type="checkbox" name="itemsizes[]" value="Medium"> medi<br>
                        </div>

                        <div id="newSizeContainer" style="display: none;">
                            <input type="text" id="newSizeInput" placeholder="Add new size and press Enter">
                        </div>
                        <button type="button" id="addSizeBtn">Add size</button>
                    </div>
                    <input type="submit" id="submitbtn" value="Submit">
            </div>
            
        </div>
        </form>               
    </div>
<?php
var_dump($_POST['storeid']);
var_dump($_POST['itemvariants']);
var_dump($_POST['itemsizes']);
?>


   
</body>

<script>
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
                var newCheckbox = document.createElement('input');
                newCheckbox.type = 'checkbox';
                newCheckbox.name = 'itemvariants[]';
                newCheckbox.value = newVarietyInput.value;
                var newLabel = document.createElement('label');
                newLabel.innerHTML = newVarietyInput.value;

                var varietyOption = document.createElement('div');
                varietyOption.id = 'varietyOption'; 
                varietyOption.appendChild(newCheckbox);
                varietyOption.appendChild(newLabel);
                varietiesContainer.appendChild(varietyOption);
                newVarietyInput.value = '';
                newVarietyContainer.style.display = 'none';
            }
        });
    </script>
<script>
        var sizesContainer = document.getElementById('sizesContainer');
        var newSizeContainer = document.getElementById('newSizeContainer');
        var newSizeInput = document.getElementById('newSizeInput');
        var addSizeBtn = document.getElementById('addSizeBtn');
        var toggleSizeDiv = document.getElementById('toggleSizeDiv');

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

                var newSizeLabel = document.createElement('label');
                newSizeLabel.innerHTML = ' ' + newSizeInput.value;

                var sizeOption = document.createElement('div');
                sizeOption.className = 'size-option';
                sizeOption.appendChild(newSizeCheckbox);
                sizeOption.appendChild(newSizeLabel);

                sizesContainer.appendChild(sizeOption);

                newSizeInput.value = '';

                newSizeContainer.style.display = 'none';
            }
        });

        toggleSizeDiv.addEventListener('change', function() {
            var sizediv = document.querySelector('.sizediv');
            sizediv.style.display = this.checked ? 'block' : 'none';
        });
    </script>


<script>
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && e.target.tagName.toLowerCase() !== 'textarea' && e.target.type !== 'submit') {
                e.preventDefault();
            }
        });
    </script>




</html>