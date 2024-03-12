
<!DOCTYPE html>
<html lang="en">
<body>
    <style>
    .dataTables_filter label{
        display: flex !important;
        justify-content:end !important;
    }
    </style>
    <?php
        $currentpage='staffs';
        require_once('../include/sidebarstore.php');
    ?>
      
    <div class="right">   
    <div class="alert alert-success staffadded staffadded1 d-none" role="alert">
            <strong class="strongsuccess">Success! </strong>A staff has been added.
        </div> 
        <div class="alert alert-success staffadded updated d-none" role="alert">
            <strong class="strongsuccess">Success! </strong>A staff details has been edited.
    </div>   
    <div class="alert alert-success staffadded deletestaff d-none" role="alert">
            <strong class="strongsuccess">Success! </strong>A staff details has been removed.
    </div>   
        <div class="productrank">
       <br>
        <p class="stafftxt">Staffs</p>
        <div class="d-flex justify-content-end">
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
                <th>Staff name</th>
                <th>Contact no</th>
                <th>Role</th>
                <th>Action</th>
                
                </tr>
            </thead>
            <tbody>
                <?php 
                $rank=1;
                    foreach($storestaff as $storestaffs){
                      
                        ?>
                        <tr>
                        <td class="ranktxt"><?php echo $rank ?></td>
                        <td class="notranktxt"><?php if (isset($storestaffs['stafffname'])){echo $storestaffs['stafffname'];}?></td>
                        <td class="notranktxt"><?php if (isset($storestaffs['staffcontactno'])){echo $storestaffs['staffcontactno'];}?></td>
                        <td class="notranktxt"><?php if (isset($storestaffs['staffrole'])){echo $storestaffs['staffrole'];}?></td>
                       
                        <td class="notranktxt">
                            <?php if ($storestaffs['staffrole']!='Manager' && $storestaffs['staffrole']!='Owner'){?>
                                <button type="button" data-bs-toggle="modal" style="border: none; background: none; padding: 0; cursor: pointer;" data-bs-target="#deleteModal<?php echo $storestaffs['staffid'];?>">
                                <i class='bx bxs-trash-alt' class="boxshadow"></i>
                                </button>
                                <i class='bx bxs-edit-alt' class="boxshadow" data-bs-toggle="modal" style="border: none; background: none; padding: 0; cursor: pointer;" data-bs-target="#addstaffstore<?php echo $storestaffs['staffid'];?>"></i>
                            <?php } ?>
                            <?php if ($storestaffs['staffrole']=='Manager' || $storestaffs['staffrole']=='Owner'){?>
                                <button type="button" data-bs-toggle="modal" style="border: none; background: none; padding: 0; cursor: pointer;" data-bs-target="#viewmodal<?php echo $storestaffs['staffid'];?>">
                                <i class='bx bx-show' class="boxshadow"></i>
                                </button>
                            <?php } ?>  
                        </td>
                            
                        
                        </tr>
                        <div class="modal fade" id="deleteModal<?php echo $storestaffs['staffid'];?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                            <input type="hidden" name="editstaffid" value="<?php echo $storestaffs['staffid'];?>">
                                            <button type="submit" class="btn btn-danger" style="cursor: pointer;">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal modaledit fade" id="addstaffstore<?php echo $storestaffs['staffid'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog addstaffmodaldialog">
                                <div class="modal-content addstaffmodalcontent">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../database/updatestaff.php" method="POST" class="needs-validation" novalidate>
                                <div class="modal-body addstaffmodalbody">
                                    
                                        <p class="formtxt">Personal Information</p>
                                        <div class="persoinfo">
                                            <div class="addstaffinput">
                                                <label class="form-label" for="fname">First Name </label>
                                                <input class="form-control" type="text" name="fname" id="" value=<?php echo $storestaffs['stafffname'];?> required>
                                                <div class="invalid-feedback">Please enter a valid first name.</div>
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label"  for="mname">Middle Name <span class="optional">(Optional)</span></label>
                                                <input class="form-control" type="text" name="mname" id="" value=<?php echo $storestaffs['staffmname'];?>>
                                                
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label" for="lname">Last Name</label>
                                                <input class="form-control" type="text" name="lname" id="" value=<?php echo $storestaffs['stafflname'];?> required>
                                                <div class="invalid-feedback">Please enter a valid last name.</div>
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label" for="contactno">Contact Number</label>
                                                <input class="form-control" type="number" name="contactno" id="" value=<?php echo $storestaffs['staffcontactno'];?> required>
                                                <div class="invalid-feedback">Please enter a valid contact number.</div>
                                            </div>
                                            
                                        </div>
                                        <?php if($storestaffs['staffrole']!='Owner'){ ?>
                                        <label class="form-label" for="role">Role</label>
                                        <select name="role" id="role" class="form-select">
                                            <option value="Cashier" <?php if($storestaffs['staffrole']=='Cashier'){ echo 'selected';}?>>Cashier</option>
                                            <option value="Manager" <?php if($storestaffs['staffrole']=='Manager'){ echo 'selected';}?>>Manager</option>
                                            <option value="Cook" <?php if($storestaffs['staffrole']=='Cook'){ echo 'selected';}?>>Cook</option>
                                            <option value="Server" <?php if($storestaffs['staffrole']=='Server'){ echo 'selected';}?>>Server</option>
                                            <option value="Server" <?php if($storestaffs['staffrole']=='Owner'){ echo 'selected';}?>>Owner</option>
                                        </select>
                                        <br>
                                        
                                        <p class="formtxt">Login Credentials</p>
                                        <div class="logincred">
                                            <div class="addstaffinput">
                                                <label class="form-label" for="email">Email Address</label>
                                                <input class="form-control" type="email" name="email" id="" value=<?php echo $storestaffs['staffemail']; ?> required>
                                                <div class="invalid-feedback">Please enter a valid email address.</div>
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label" for="password">Password</label>
                                                <input class="form-control" type="password" name="password" id="">
                                                <input class="form-control" hidden type="number" name="staffid" id="" value=<?php echo $storestaffs['staffid']; ?> required>
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
                        <div class="modal modaledit fade" id="viewmodal<?php echo $storestaffs['staffid'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog addstaffmodaldialog">
                                <div class="modal-content addstaffmodalcontent">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../database/updatestaff.php" method="POST" class="needs-validation" novalidate>
                                <div class="modal-body addstaffmodalbody">
                                    
                                        <p class="formtxt">Personal Information</p>
                                        <div class="persoinfo">
                                            <div class="addstaffinput">
                                                <label class="form-label" for="fname">First Name </label>
                                                <input class="form-control" type="text" name="fname" id="" value=<?php echo $storestaffs['stafffname'];?> readonly>
                                                <div class="invalid-feedback">Please enter a valid first name.</div>
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label"  for="mname">Middle Name <span class="optional">(Optional)</span></label>
                                                <input class="form-control" type="text" name="mname" id="" readonly value=<?php echo $storestaffs['staffmname'];?> >
                                                
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label" for="lname">Last Name</label>
                                                <input class="form-control" type="text" name="lname" id="" value=<?php echo $storestaffs['stafflname'];?> readonly>
                                                <div class="invalid-feedback">Please enter a valid last name.</div>
                                            </div>
                                            <div class="addstaffinput">
                                                <label class="form-label" for="contactno">Contact Number</label>
                                                <input class="form-control" type="number" name="contactno" id="" value=<?php echo $storestaffs['staffcontactno'];?> readonly>
                                                <div class="invalid-feedback">Please enter a valid contact number.</div>
                                            </div>
                                            
                                        </div>
                                        
                                        <label class="form-label" for="role">Role</label>
                                        <select name="role" id="role" class="form-select" disabled>
                                            <option value="Cashier" <?php if($storestaffs['staffrole']=='Cashier'){ echo 'selected';}?>>Cashier</option>
                                            <option value="Manager" <?php if($storestaffs['staffrole']=='Manager'){ echo 'selected';}?>>Manager</option>
                                            <option value="Cook" <?php if($storestaffs['staffrole']=='Cook'){ echo 'selected';}?>>Cook</option>
                                            <option value="Server" <?php if($storestaffs['staffrole']=='Server'){ echo 'selected';}?>>Server</option>
                                            <option value="Server" <?php if($storestaffs['staffrole']=='Owner'){ echo 'selected';}?>>Owner</option>
                                        </select>
                                        <br>
                                        
                                        <p class="formtxt">Login Credentials</p>
                                        <div class="logincred">
                                            <div class="addstaffinput">
                                                <label class="form-label" for="email">Email Address</label>
                                                <input class="form-control" type="email" name="email" id="" value=<?php echo $storestaffs['staffemail']; ?> readonly>
                                                <div class="invalid-feedback">Please enter a valid email address.</div>
                                            </div>
                                            
                                            
                                        </div>
                                        
                                        
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     
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
                            <input class="form-control" type="text" name="lname" id="" required>
                            <div class="invalid-feedback">Please enter a valid last name.</div>
                        </div>
                        <div class="addstaffinput">
                            <label class="form-label" for="contactno">Contact Number</label>
                            <input class="form-control" type="number" name="contactno" id="" required>
                            <div class="invalid-feedback">Please enter a valid contact number.</div>
                        </div>
                        
                    </div>
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
                            <input class="form-control" type="email" name="email" id="">
                        </div>
                        <div class="addstaffinput">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="" required>
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
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg']=='editstaff'): ?>
        <script>
            setTimeout(function() {
                $('.updated').removeClass('d-none').fadeIn(1000, function() {
                    $(this).delay(3000).fadeOut(1000); 
                });
            }, 1000);
        </script>
    <?php endif; ?>

    <?php if (isset($_SESSION['msg']) && $_SESSION['msg']=='addstaff'): ?>
        <script>
            setTimeout(function() {
                $('.staffadded1').removeClass('d-none').fadeIn(1000, function() {
                    $(this).delay(3000).fadeOut(1000); 
                });
            }, 1000);
        </script>
    <?php endif; ?>

    <?php if (isset($_SESSION['msg']) && $_SESSION['msg']=='deletestaff'): ?>
        <script>
            setTimeout(function() {
                $('.deletestaff').removeClass('d-none').fadeIn(1000, function() {
                    $(this).delay(3000).fadeOut(1000); 
                });
            }, 1000);
        </script>
    <?php endif; ?>

    <script>
    $(document).ready(function() {
       

        var dataTable = $('#dataTable').DataTable({
           
            lengthChange: false,  
            pageLength: 8, 
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


            dataTable.columns(3).search(role).draw();
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
<script>
    (function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })
        
        var nameFields = document.querySelectorAll('.modal input[type="text"]:not([readonly]), .modal input[type="text"]:not([readonly])');

        nameFields.forEach(function(field) {
            field.addEventListener('input', function() {
                var sanitizedValue = field.value.replace(/[^A-Za-z\s]/g, '');
                if (field.value !== sanitizedValue) {
                    field.value = sanitizedValue;
                }
            });
        });
    })()
</script>
<script>
    
    $(document).on('submit', '.modaladd form', function(e) {
        e.preventDefault(); 
        var formData = new FormData(this); 

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                
                $('#addstaffstore').modal('hide'); 
                window.location.reload();
            }
        });
    });
</script>

<script>
    $(document).on('shown.bs.modal', '.modaledit', function (e) {
    var form = $(this).find('form');

    form.on('submit', function(e) {
        e.preventDefault(); 
        var formData = new FormData(this); 

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.modaledit').modal('hide'); 
                window.location.reload();
            }

        });
    });
});



</script>


    

</body>
</html>