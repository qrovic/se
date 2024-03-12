
<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    if(!isset($_SESSION['$storestoreid'])){
        
    }
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
?>
<body>
    <style>
    .dataTables_filter label{
        display: flex !important;
        justify-content:end !important;
    }
    </style>
    <?php
        $currentpage='menus';
        require_once('../include/sidebarstore.php');
    ?>
    <div class="right">    
        <div class="productrank">
       <br>
        <p class="stafftxt">Menus</p>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary addstaffbtn" onclick="window.location.href='../store/additemcopy.php'">Add Menu</button>
        </div>

        <div class="overviewstaffsheader">
            <div class="filteroverview">
                <div class="categoryfilter">
                    <label class="labeloverview" for="role" >Category:</label>
                    <select name="role" id="role" class="form-select">
                        <option value="">All Categories</option>
                        <option value="Populars">Populars</option>
                        <option value="Drinks">Drinks</option>
                        <option value="Meals">Meals</option>
                        <option value="Snacks">Snacks</option>
                        <option value="Combos">Combos</option>
                        <option value="Items">Items</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button id="pdfButton" class="btn btn-primary excelpdf" style="background-color: white; color: black; border-color: gray;"><i class='bx bxs-file-pdf'></i>PDF</button>
                    <button id="excelButton" class="btn btn-primary excelpdf" style="background-color: white; color: black; border-color: gray;"><i class='bx bxs-spreadsheet'></i>Excel</button>
                    <button id="printButton" class="btn btn-primary excelpdf" style="background-color: white; color: black; border-color: gray;"><i class='bx bxs-printer'></i>Print</button>
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label class="" for="search" >Search:</label>
                    </div>
                    <div class="col-auto">
                        <input type="searchstaff" class="form-control" id="searchstaff">
                    </div>
                </div>
            
            </div>
           
        </div>
        


        <table id="dataTable" class="table superadminoverview table-hover">
            <thead >
                <tr>
                <th class="rankhead">ID</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
               
                
                </tr>
            </thead>
            <tbody>
                <?php 
                $rank=1;
                    foreach($storeitems as $storeitem){
                      
                        ?>
                        <tr>
                        <td class="ranktxt"><?php echo $rank ?></td>
                        <td class="notranktxt"><?php if (isset($storeitem['name'])){echo $storeitem['name'];}?></td>
                        <td class="notranktxt"><?php if (isset($storeitem['category'])){echo $storeitem['category'];}?></td>
                        <td class="notranktxt"><?php if (isset($storeitem['status'])){echo $storeitem['status'];}?></td>
                        <td class="notranktxt">
                            
                      
                            <?php if ($storeitem['status']=='Active'){ ?>
                                <form action="../database/deleteitem.php" method="post" style="display: inline;">
                                    <input type="hidden" name="editstoreid" value="<?php echo $storeitem['id'];?>">
                                    <button type="submit" data-bs-toggle="modal" style="border: none; background: none; padding: 0; cursor: pointer;">
                                        <i class='bx bx-toggle-right'></i>
                                    </button>
                                </form>
                            <?php }else{ ?>
                                <form action="../database/deleteitem.php" method="post" style="display: inline;">
                                    <input type="hidden" name="editstoreid" value="<?php echo $storeitem['id'];?>">
                                    <button type="submit" data-bs-toggle="modal" style="border: none; background: none; padding: 0; cursor: pointer;">
                                        <i class='bx bx-toggle-left'></i>
                                    </button>
                                </form>
                            <?php } ?>
                                
                           
                            <form action="../store/editmenu.php" method="post" style="display: inline;">
                                <input type="hidden" name="editstoreid" value="<?php echo $storeitem['id']; ?>">
                                <button type="submit" style="border: none; background: none; padding: 0; cursor: pointer;">
                                    <i class='bx bxs-edit-alt'></i>
                                </button>
                            </form>
                            <form action="../store/inventory.php" method="post" style="display: inline;">
                                <input type="hidden" name="editstoreid" value="<?php echo $storeitem['id']; ?>">
                                <button type="submit" style="border: none; background: none; padding: 0; cursor: pointer;">
                                    <i class='bx bx-box'></i>
                                </button>
                            </form>
                        </td>
                        

                        </tr>
                        <div class="modal fade" id="deleteModal<?php echo $storeitem['id'];?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Switch</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to switch this item?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="../database/deleteitem.php" method="post" style="display: inline;">
                                            <input type="hidden" name="editstoreid" value="<?php echo $storeitem['id'];?>">
                                            <button type="submit" class="btn btn-danger" style="cursor: pointer;">
                                                Switch
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $rank=$rank+1;
                        
                    }
                ?>
            </tbody>
        </table>


        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addstaffmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                
            <div class="modal-content">
            
            <div class="modal-body">
                <div class="modaltitle">
                    <h5 class="modal-title" id="exampleModalLabel">Add Store</h5>
                </div>
                    
                
                <form action="../database/addstore.php" method="POST" enctype="multipart/form-data">
                    <div class="upperaddacc">
                        
                    <div class="addacclogo" style="background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url(''); background-position: center; background-size: cover;">
                            
                            <label for="file" class="btn uploadbtn"><i class='bx bx-upload'></i>Upload</label>
                            <input id="file" name="storepic" type="file" onchange="previewimg(this);">
                            
                        </div>
                        <div class="storeinfo">
                        <h4 class="ownerdetailstext">Store Details</h4>
                            <div class="storeinforow">
                                <div class="labelinput">
                                    <label for="" class="form-label">Store Name</label>
                                    <input type="text" class="form-control" name="storename" id="" placeholder="">
                                </div>
                                <div>
                                    <label for="" class="form-label">Contact</label>
                                    <input type="number" name="ownercontact" class="form-control ownercontact" id="" placeholder="">
                                </div>
                            </div>
                            <div class="storeinfodescription">
                                <label for="" class="form-label">Description/Tagline</label>
                                <input type="text" name="storedescription" class="form-control" id="" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="addstorebelow">
                        <h4 class="ownerdetailstext">Owner Details</h4>
                        <div class="storeinforow">
                            
                            <div class="labelinput">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" name="ownerfname" class="form-control" id="" placeholder="">
                            </div>
                            <div class="labelinput">
                                <label for="" class="form-label">Middle Name</label>
                                <input type="text" name="ownermname" class="form-control" id="" placeholder="">
                            </div>
                            <div class="labelinput labelinputright">
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" name="ownerlname" class="form-control" id="" placeholder="">
                            </div>
                            
                        </div>
                        <div class="storeinforow">
                            
                            <div class="labelinput">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="owneremail" class="form-control" id="" placeholder="">
                            </div>
                            <div class="labelinput labelinputright">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="ownerpassword"class="form-control" id="" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary greenbtn">Add Store</button>
                    </div>
                </form>
            </div>
            
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
       

        var dataTable = $('#dataTable').DataTable({
           
            lengthChange: false,  
            pageLength: 15, 
            paging: true,  
            pagingType: 'simple',
            language: {
            info: '' 
        },
        buttons: [
            'copy',
            'excel',
            'pdf',
            'print'
        ]
        });

        $('#role').on('change', function() {
            var role = $('#role').val();


            dataTable.columns(2).search(role).draw();
        });
        $('#searchstaff').on('keyup', function () {
            dataTable.search(this.value).draw();
        });
        $('#pdfButton').on('click', function() {
            dataTable.buttons('.buttons-pdf').trigger();
        });

        $('#excelButton').on('click', function() {
            dataTable.buttons('.buttons-excel').trigger();
        });

        $('#printButton').on('click', function() {
            dataTable.buttons('.buttons-print').trigger();
        });

        $('.dataTables_filter').addClass('d-none');
    });
</script>


    

</body>
</html>