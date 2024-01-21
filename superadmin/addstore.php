
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
        <div class="addstore">
            <div class="storedetails">
                <h2>Store Details</h2>
                <form action="../database/addstore.php" method="POST" enctype="multipart/form-data">
                    <div class="addstoreinput">
                        <label for="">Store Name:</label>
                        <input type="text" name="storename" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Store Description:</label>
                        <input type="text" name="storedescription" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Store Status:</label>
                        <input type="text" name="storestatus" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Store Pic:</label>
                        <input type="file" name ="storepic" src="" alt="">
                    </div>
            </div>
            <div class="ownerdetails">
                    <h2>Owner Details</h2>
                    <div class="addstoreinput">
                        <label for="">Customer First Name:</label>
                        <input type="text" name="ownerfname" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Customer Middle Name:</label>
                        <input type="text" name="ownermname" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Customer Last Name:</label>
                        <input type="text" name="ownerlname" id="">
                    </div>

                    <div class="addstoreinput">
                        <label for="">Owner Contact:</label>
                        <input type="text" name="ownercontact" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Owner Email:</label>
                        <input type="text" name="owneremail" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Owner Address:</label>
                        <input type="text" name="owneraddress" id="">
                    </div>
                    <input class="btn btn-primary" type="submit" value="submit">
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
</html>