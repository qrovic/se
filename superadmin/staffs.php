
<!DOCTYPE html>
<html lang="en">
<?php
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
        $currentpage='staffs';
        require_once('../include/sidebar.php');
    ?>
    <div class="right">    
        <div class="productrank">
       <br>
        <p class="monthlyproducttxt">Staffs</p>
        <div class="overviewstaffsheader">
            <div class="filteroverview">
                <div class="categoryfilter">
                    <label class="labeloverview" for="role" >Role:</label>
                    <select name="role" id="role" class="form-select">
                        <option value="">All roles</option>
                        <option value="Manager">Manager</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Owner">Owner</option>
                        <option value="Server">Server</option>
                        <option value="Cook">Cook</option>
                    </select>
                </div>
            
                <div class="storefilter">
                    <label class="labeloverview" for="store" >Store:</label>
                    <select name="store" id="store" class="form-select">
                        <option value="">All stores</option>
                        <?php foreach ($allstores as $store): ?>
                            <option value="<?php echo $store['name']; ?>"><?php echo $store['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-primary addstaffbtn" data-bs-toggle="modal" data-bs-target="#addstaffmodal">Add Staff</button>
        </div>
        


        <table id="dataTable" class="table superadminoverview table-striped table-hover">
            <thead >
                <tr>
                <th class="rankhead">Rank</th>
                <th>Staff name</th>
                <th>role</th>
                <th>store</th>
                
                </tr>
            </thead>
            <tbody>
                <?php 
                $rank=1;
                    foreach($superadminstaffs as $superadminstaff){
                      
                        ?>
                        <tr>
                        <td class="ranktxt"><?php echo $rank ?></td>
                        <td class="notranktxt"><?php if (isset($superadminstaff['stafffname'])){echo $superadminstaff['stafffname'];}?></td>
                        <td class="notranktxt"><?php if (isset($superadminstaff['staffrole'])){echo $superadminstaff['staffrole'];}?></td>
                        <td class="notranktxt"><?php if (isset($superadminstaff['staffstorename'])){echo $superadminstaff['staffstorename'];}?></td>
                        
                        </tr>
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
            pageLength: 10, 
            paging: true,  
            pagingType: 'simple',
            language: {
            info: '' 
        }
        });

        $('#role').on('change', function() {
            var role = $('#role').val();


            dataTable.columns(2).search(role).draw();
        });

        $('#store').on('change', function() {
           
            var store = $('#store').val();

            dataTable.columns(3).search(store).draw();
        });
    });
</script>


    

</body>
</html>