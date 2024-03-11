
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
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary addstaffbtn" data-bs-toggle="modal" data-bs-target="#addstaffstore">Add Staff</button>
        </div>
        
        


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


        <table id="dataTable" class="table superadminoverview table-striped table-hover">
            <thead >
                <tr>
                <th class="rankhead">Rank</th>
                <th>Staff name</th>
                <th>Role</th>
                <th>Store Name</th>
                <th>Action</th>
                
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
                        <td class="notranktxt">
                            <button type="button" data-bs-toggle="modal" style="border: none; background: none; padding: 0; cursor: pointer;" data-bs-target="#deleteModal<?php echo $superadminstaff['staffid'];?>">
                            <i class='bx bxs-trash-alt'></i>
                            </button>
                            <i class='bx bxs-edit-alt' data-bs-toggle="modal" data-bs-target="#editstorestaff<?php echo $superadminstaff['staffid'];?>"></i></td>
                        </tr>
                        <div class="modal fade" id="deleteModal<?php echo $superadminstaff['staffid'];?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this item?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="../database/deletestaff.php" method="post" style="display: inline;">
                                            <input type="hidden" name="editstaffid" value="<?php echo $superadminstaff['staffid']; ?>">
                                            <button type="submit" class="btn btn-danger" style="cursor: pointer;">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal modaledit fade" id="editstorestaff<?php echo $superadminstaff['staffid'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog addstaffmodaldialog">
                                <div class="modal-content addstaffmodalcontent">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Staff Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../database/updatestaff.php" method="POST" class="needs-validation" novalidate>
                                <div class="modal-body addstaffmodalbody">
                                    
                                        <p class="formtxt">Personal Information</p>
                                        <div class="persoinfo">
                                            <div class="addstaffinput">
                                                <label class="form-label" for="fname">First Name </label>
                                                <input class="form-control" type="text" name="fname"  value=<?php echo $superadminstaff['stafffname'];?> required>
                                                <div class="invalid-feedback">Please enter a valid first name.</div>
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label"  for="mname">Middle Name <span class="optional">(Optional)</span></label>
                                                <input class="form-control" type="text" name="mname" value=<?php echo $superadminstaff['staffmname'];?>>
                                                
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label" for="lname">Last Name</label>
                                                <input class="form-control" type="text" name="lname"  value=<?php echo $superadminstaff['stafflname'];?> required>
                                                <div class="invalid-feedback">Please enter a valid last name.</div>
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label" for="contactno">Contact Number</label>
                                                <input class="form-control" type="number" name="contactno"  value=<?php echo $superadminstaff['staffcontactno'];?> required>
                                                <div class="invalid-feedback">Please enter a valid contact number.</div>
                                            </div>
                                            
                                        </div>
                                        <?php if($superadminstaff['staffrole']!='Owner'){ ?>
                                        <label class="form-label" for="role">Store</label>
                                        <select name="storestoreid" id="store" class="form-select">
                                            <?php foreach ($allstores as $store): ?>
                                                <option value="<?php echo $store['id']; ?>" <?php if($superadminstaff['storeid']==$store['id']){ echo 'selected';}?>><?php echo $store['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <br>
                                        <label class="form-label" for="role">Role</label>
                                        <select name="role" id="role" class="form-select">
                                            <option value="Cashier" <?php if($superadminstaff['staffrole']=='Cashier'){ echo 'selected';}?>>Cashier</option>
                                            <option value="Manager" <?php if($superadminstaff['staffrole']=='Manager'){ echo 'selected';}?>>Manager</option>
                                            <option value="Cook" <?php if($superadminstaff['staffrole']=='Cook'){ echo 'selected';}?>>Cook</option>
                                            <option value="Server" <?php if($superadminstaff['staffrole']=='Server'){ echo 'selected';}?>>Server</option>
                                            <option value="Server" <?php if($superadminstaff['staffrole']=='Owner'){ echo 'selected';}?>>Owner</option>
                                        </select>
                                        <br>
                                        <p class="formtxt">Login Credentials</p>
                                        <div class="logincred">
                                            <div class="addstaffinput">
                                                <label class="form-label" for="email">Email Address</label>
                                                <input class="form-control" type="email" name="email"  value=<?php echo $superadminstaff['staffemail']; ?> required>
                                                <div class="invalid-feedback">Please enter a valid email address.</div>
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label" for="password">Password</label>
                                                <input class="form-control" type="password" name="password" >
                                                <input class="form-control" hidden type="number" name="staffid"  value=<?php echo $superadminstaff['staffid']; ?> required>
                                                <div class="invalid-feedback">Please enter a valid password.</div>
                                            </div>
                                            
                                        </div>
                                        <?php } ?>
                                        
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary addstaffsubmit">Save changes</button>
                                </div>
                                </form>
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
    <div class="modal modaladd fade" id="addstaffstore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog addstaffmodaldialog">
            <div class="modal-content addstaffmodalcontent">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../database/addstaff.php" method="POST" class="needs-validation" novalidate>
            <div class="modal-body addstaffmodalbody">
                
                    <p class="formtxt">Personal Information</p>
                    <div class="persoinfo">
                        <div class="addstaffinput">
                            <label class="form-label" for="fname">First Name </label>
                            <input class="form-control" type="text" name="fname" id="fname" required>
                            <div class="invalid-feedback">Please enter a valid first name.</div>
                        </div>
                        <div class="addstaffinput">
                            <label class="form-label"  for="mname">Middle Name <span class="optional">(Optional)</span></label>
                            <input class="form-control" type="text" name="mname" id="mname">
            
                        </div>
                        <div class="addstaffinput">
                            <label class="form-label" for="lname">Last Name</label>
                            <input class="form-control" type="text" name="lname"  required>
                            <div class="invalid-feedback">Please enter a valid last name.</div>
                        </div>
                        <div class="addstaffinput">
                            <label class="form-label" for="contactno">Contact Number</label>
                            <input class="form-control" type="number" name="contactno"  required>
                            <div class="invalid-feedback">Please enter a valid contact number.</div>
                        </div>
                        
                    </div>
                    <label class="form-label" for="storestoreid">Store</label>
                    <select name="storestoreid" id="store" class="form-select">
                        <?php foreach ($allstores as $store): ?>
                            <option value="<?php echo $store['id']; ?>"><?php echo $store['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <label class="form-label" for="role">Role</label>
                    <select name="role" id="role" class="form-select">
                        <option value="Cashier">Cashier</option>
                        <option value="Manager">Manager</option>
                        <option value="Cook">Cook</option>
                        <option value="Server">Server</option>
                    </select>
                    <br>
                    <p class="formtxt">Login Credentials</p>
                    <div class="logincred">
                        <div class="addstaffinput">
                            <label class="form-label" for="email">Email Address</label>
                            <input class="form-control" type="email" name="email" >
                        </div>
                        <div class="addstaffinput">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" type="password" name="password"  required>
                            <div class="invalid-feedback">Please enter a valid contact number.</div>
                        </div>
                        
                    </div>
                    
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary addstaffsubmit">Save changes</button>
            </div>
            </form>
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
        },
        buttons: [
            'copy',
            'excel',
            'pdf',
            'print'
        ]
    });

    $('#searchstaff').on('keyup', function () {
        dataTable.search(this.value).draw();
    });

    $('#role').on('change', function() {
        var role = $('#role').val();
        dataTable.columns(2).search(role).draw();
    });

    $('#store').on('change', function() {
        var store = $('#store').val();
        dataTable.columns(3).search(store).draw();
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