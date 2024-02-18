
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
        require_once('../include/sidebar.php');
    ?>
    <div class="right">
            <p class="superadmintxt">Welcome, <?php echo $_SESSION['name'];?></p>
        <div class="storestat">
            <div class="stores">
                <p class="storenumber"><?php if($onlinestorescount){ echo $onlinestorescount;}else{ echo 0;}?></p>
                <div class="storestext">
                    <p>STORES</p>
                    <p>OPEN</p>
                </div>
                
            </div>
            <div class="stores">
                <p class="storenumber"><?php if($totalstorescount){ echo $totalstorescount;}else{ echo 0;}?></p>
                <div class="storestext">
                    <p>TOTAL</p>
                    <p>STORES</p>
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
           
            <div class="storefilter">
                <label class="labeloverview" for="store" >Store:</label>
                <select name="store" id="store" class="form-select">
                    <?php foreach ($allstores as $store): ?>
                        <option value="<?php echo $store['name']; ?>"><?php echo $store['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
       


        <table id="dataTable" class="table superadminoverview table-borderless">
            <thead>
                <tr>
                <th class="rankhead">Rank</th>
                <th>Product</th>
                <th>Category</th>
                <th>Store</th>
                <th class="rankhead">Sales</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $rank=1;
                    foreach($topproduct as $topproducts){
                      
                        ?>
                        <tr>
                        <td class="ranktxt"><?php echo $rank ?></td>
                        <td class="notranktxt"><?php if (isset($topproducts['itemname'])){echo $topproducts['itemname'];}?></td>
                        <td class="notranktxt"><?php if (isset($topproducts['itemcategory'])){echo $topproducts['itemcategory'];}?></td>
                        <td class="notranktxt"><?php if (isset($topproducts['storename'])){echo $topproducts['storename'];}?></td>
                        <td class="ranktxt"><?php if (isset($topproducts['totalquantity'])){echo $topproducts['totalquantity'];}?></td>
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