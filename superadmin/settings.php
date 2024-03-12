<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
       
?>
<body>
    <?php
        $currentpage='settings';
        require_once('../include/sidebar.php');
    ?>
    <div class="right storeright">
        <p class="stafftxt">Settings</p>
        <div class="setting">
            <?php if ($settingerror){ ?>
                <div class="alert alert-danger" role="alert">
                Wrong Old Password!
                </div>
            <?php } ?>
            <div class="formsetting">
                <div class="uppersettingsuperadmin">
                    <label class="form-label labeltxt" for="storedetails">Owner Personal Information</label>
                    <div class="leftuppersuperadmin">
                        
                        <div class="storedetailssetting">
                            <label class="form-label" for="storename">First Name</label>
                            <input type="text" class="form-control" name="storename" id="storename">
                        </div>
                        <div class="storedetailssetting">
                            <label class="form-label" for="storedescription">Middle Name </label>
                            <input type="text" class="form-control" name="storedescription" id="storedescription">
                        </div>
                    </div>
                </div>
                <div class="lowersetting">
                    <label class="form-label labeltxt" for="storedetails">Login Details</label>
                    <div class="lowerlower">
                        <div class="storedetailssetting lowerrow">
                            <label class="form-label" for="storemail">Email</label>
                            <input type="text" class="form-control" name="storemail" id="storemail">
                        </div>
                        <div class="storedetailssetting">
                            <label class="form-label" for="storecontact">Contact No.</label>
                            <input type="text" class="form-control" name="storecontact" id="storecontact">
                        </div>
                    </div>
                    <div class="lowerlower">
                        <div class="storedetailssetting lowerrow">
                            <label class="form-label" for="storeoldpass">Old Password</label>
                            <input type="text" class="form-control" name="storeoldpass" id="storeoldpass">
                        </div>
                        <div class="storedetailssetting ">
                            <label class="form-label" for="storenewpass">New Password</label>
                            <input type="text" class="form-control" name="storenewpass" id="storenewpass">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
