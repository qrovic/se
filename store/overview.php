
<!DOCTYPE html>
<html lang="en">

<body>
    <style>

    .dataTables_filter {
        display: none;
    }
    .pagination{
        display: none;
    }  
    </style>
    <?php
        $currentpage='overview';
        require_once('../include/sidebarstore.php');
    ?>
    <div class="right">
        <div class="storeinfooverview">
            <div class="storeoverview">
                <?php foreach ($storedeets AS $storedeet){ ?>
                <img class="storelogooverview" src="../resources/<?php echo $storedeet['pic']?>" alt="">
                <div class="storeinfotxt">
                    
                    <p class="overviewstorename"><?php echo $storedeet['name']?></p>
                    <p><?php echo $storedeet['description']?></p>
                <?php } ?>
                
                </div>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input"  type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Store is closed</label>
            </div>
        </div>
        <div class="storestat">
            <div class="stores">
                <p class="storenumber"><?php if(isset($salecount)){ echo $salecount;}else{ echo '0'; }?></p>
                <div class="storestext">
                    <p>ITEMS</p>
                    <p>SOLD</p>
                </div>
                
            </div>
            <div class="stores">
                <p class="storenumber"><?php if(isset($staffcount)){ echo $staffcount;}else{ echo 0; }?></p>
                <div class="storestext">
                    <p></p>
                    <p>STAFF</p>
                </div>
            </div>
        </div>
        
        <div class="productrank">
        <hr>
        <p class="monthlyproducttxt">Montly Top Products</p>
        <div class="filteroverview">
            <div class="categoryfilter">
                <label class="labeloverview" for="category" >Category:</label>
                <select name="category" id="category" class="form-select">
                   
                    <option value="drinks">Drinks</option>
                    <option value="meals">Meals</option>
                    <option value="combos">Combo</option>
                    <option value="desserts">Desserts</option>
                    
                </select>
            </div>
        </div>
       


        <table id="dataTable" class="table superadminoverview table-borderless">
            <thead>
                <tr>
                <th class="rankhead">Rank</th>
                <th>Product</th>
                <th>Category</th>
                <th class="rankhead">Sales</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $rank=1;
                    foreach($storetopproduct as $storetopproducts){
                      
                        ?>
                        <tr>
                        <td class="ranktxt"><?php echo $rank ?></td>
                        <td class="notranktxt"><?php if (isset($storetopproducts['itemname'])){echo $storetopproducts['itemname'];}?></td>
                        <td class="notranktxt"><?php if (isset($storetopproducts['itemcategory'])){echo $storetopproducts['itemcategory'];}?></td>
                        <td class="ranktxt"><?php if (isset($storetopproducts['totalquantity'])){echo $storetopproducts['totalquantity'];}?></td>
                        </tr>
                        <?php
                        $rank=$rank+1;
                        
                    }
                ?>
            </tbody>
        </table>


        </div>
    </div>
    <script>
    $(document).ready(function() {
       

        var dataTable = $('#dataTable').DataTable({
           
            lengthChange: false,  
            pageLength: 5,  
            pagingType: 'simple',
            language: {
            info: ''
        }
        });

        $('#category').on('change', function() {
            var category = $('#category').val();


            dataTable.columns(2).search(category).draw();
        });

        $('#store').on('change', function() {
           
            var store = $('#store').val();

            dataTable.columns(3).search(store).draw();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#flexSwitchCheckDefault').change(function() {
            if ($(this).is(':checked')) {
                $('.form-check-label').text('Store is opened').css('color', '');
            } else {
                $('.form-check-label').text('Store is closed').css('color', 'red');
            }
        });
    });
</script>


    

</body>
</html>