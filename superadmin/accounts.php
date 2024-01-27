<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
       
?>
<body>
    <div class="left">
        <img class="superadminstorelogo" src="../resources/foodparklogo.png" alt="hhee">
        <div class="options">
            <ul class="options">
                <li class="options">
                    <a  href="overview.php">Overview</a>
                </li>
                <li class="options">
                    <a class="active" href="overview.php">Accounts</a>
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
    <div class="right" id="rightaccount">
        <div class="accountstext">
            <p>Accounts</p>
        </div>
        
        <div class="accountsdiv" onclick="examplemodal">
            <?php
            if ($storewowner) {
                foreach ($storewowner as $storewowners) {
                    ?>
                    <div class="acoountdiv" data-bs-toggle="modal" data-bs-target="#<?php echo $storewowners['name'];?>">
                        <img class="accountlogo" src="<?php echo "../resources/" . $storewowners['pic']; ?>" onerror="this.src='../resources/noimg.png'";>
                        <div class="storename">
                            <p class="accountname"><?php echo $storewowners['name'];?></p>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="<?php echo $storewowners['name'] ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                        <div class="modal-dialog">
                                
                            <div class="modal-content">
                            
                            <div class="modal-body">
                                <div class="modaltitle">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Store</h5>
                                </div>
                                    
                                
                                <form action="../database/updatestore.php" method="POST" enctype="multipart/form-data">
                                    <div class="upperaddacc">
                                        
                                        <div class="addacclogo">
                                            
                                            <label for="file" class="btn uploadbtn"><i class='bx bx-upload'></i>Upload</label>
                                            <input id="file" name="storepic" hidden type="file">
                                            
                                        </div>
                                        <div class="storeinfo">
                                        <h4 class="ownerdetailstext">Store Details</h4>
                                            <div class="storeinforow">
                                                <div class="labelinput">
                                                    <label for="" class="form-label">Store Name</label>
                                                    <input type="text" class="form-control editinput" name="storename" id="" value="<?php echo $storewowners['name'];?>">
                                                </div>
                                                <div>
                                                    <label for="" class="form-label">Contact</label>
                                                    <input type="number" name="ownercontact" class="form-control ownercontact editinput" id="" value="<?php echo $storewowners['contactno'];?>">
                                                </div>
                                            </div>
                                            <div class="storeinfodescription">
                                                <label for="" class="form-label">Description/Tagline</label>
                                                <input type="text" name="storedescription" class="form-control editinput" id="" value="<?php echo $storewowners['description'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="addstorebelow">
                                        <h4 class="ownerdetailstext">Owner Details</h4>
                                        <div class="storeinforow">
                                            
                                            <div class="labelinput">
                                                <label for="" class="form-label">First Name</label>
                                                <input type="text" name="ownerfname" class="form-control editinput" id="" value=<?php echo $storewowners['fname'];?>>
                                            </div>
                                            <div class="labelinput">
                                                <label for="" class="form-label">Middle Name</label>
                                                <input type="text" name="ownermname" class="form-control editinput" id="" value="<?php echo $storewowners['mname'];?>">
                                            </div>
                                            <div class="labelinput labelinputright">
                                                <label for="" class="form-label">Last Name</label>
                                                <input type="text" name="ownerlname" class="form-control editinput" id="" value=<?php echo $storewowners['lname'];?>>
                                            </div>
                                            
                                        </div>
                                        <div class="storeinforow">
                                            
                                            <div class="labelinput">
                                                <label for="" class="form-label">Email</label>
                                                <input type="email" name="owneremail" class="form-control editinput" id="" <?php echo $storewowners['email'];?>>
                                            </div>
                                            <div class="labelinput labelinputright">
                                                <label for="" class="form-label">Password</label>
                                                <input type="password" name="ownerpassword"class="form-control editinput" id="" value="<?php echo $storewowners['password'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer editstorefooter">
                                        <input type="number" name="storeid" id="" value="<?php echo $storewowners['storeid'];?>" hidden>
                                        <button type="submit" class="btn btn-primary greenbtn">Save</button>
                                        </form>
                                        <form action="../database/deletestore.php" method="POST">
                                            <input type="text" name="storeid" value="<?php echo $storewowners['storeid'];?>" hidden>
                                            <button type="submit" class="btn btn-secondary greenbtn">Delete</button>
                                        </form>
                                    </div>
                                
                            </div>
                            
                            </div>
                        </div>
                    </div>
                    <?php 
                }
            }
            ?>
        </div>
    </div>
    

    <div class="addstore">
        <button type="button" class="btn btn-primary" id="add-store" data-bs-toggle="modal" data-bs-target="#addstoremodal" >
            Add Store
        </button>
    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="addstoremodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                
            <div class="modal-content">
            
            <div class="modal-body">
                <div class="modaltitle">
                    <h5 class="modal-title" id="exampleModalLabel">Add Store</h5>
                </div>
                    
                
                <form action="../database/addstore.php" method="POST" enctype="multipart/form-data">
                    <div class="upperaddacc">
                        
                        <div class="addacclogo">
                            
                            <label for="file" class="btn uploadbtn"><i class='bx bx-upload'></i>Upload</label>
                            <input id="file" name="storepic" hidden type="file">
                            
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
    

</body>
</html>
