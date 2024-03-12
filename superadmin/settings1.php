
<!DOCTYPE html>
<html lang="en">
<body>
    <?php
        $currentpage='settings';
        require_once('../include/sidebar.php');
    ?>
    <div class="right storeright">
        <p class="stafftxt">Settings</p>
        <?php foreach ($storedeets AS $storedeetsettings){ ?>
        <div class="setting">
            <form action="../database/editsettingstore.php" method="POST">
            <div class="formsetting">
                <?php if (isset($_SESSION['settingerror']) && ($_SESSION['settingerror'])){ ?>
                    <div class="alert alert-danger" role="alert">
                    Wrong Old Password!
                    </div>
                <?php } ?>
                <div class="uppersetting">
                    <div class="addacclogo editstorelogo" style="background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url('<?php echo "../resources/" . $storedeetsettings['pic']; ?>'); background-position: center; background-size: cover;">
                        <label for="file" class="btn uploadbtn"><i class='bx bx-upload'></i>Upload</label>
                        <input id="file" name="storepicsetting" hidden <?php if ($_SESSION['role']!='Owner'){ echo 'disabled';}?> type="file" value="<?php echo $storedeetsettings['pic'];?>" onchange="previewimg(this);">
                        <input type="text" name="storepicbackup" value="<?php echo $storedeetsettings['pic'];?>" hidden>
                    </div>
                    <div class="leftupper">
                        <label class="form-label labeltxt" for="storedetails">Store Details</label>
                        <div class="storedetailssetting">
                            <label class="form-label" for="storename">Store Name</label>
                            <input type="text" class="form-control" name="storename" value='<?php echo $storedeetsettings['name'];?>' id="storename" <?php if ($_SESSION['role']!='Owner'){ echo 'readonly';}?>>
                        </div>
                        <div class="storedetailssetting">
                            <label class="form-label" for="storedescription">Store Description</label>
                            <input type="text" class="form-control" name="storedescription" value='<?php echo $storedeetsettings['description'];?>' id="storedescription" <?php if ($_SESSION['role']!='Owner'){ echo 'readonly';}?>>
                        </div>
                    </div>
                </div>
                <div class="lowersetting">
                    <label class="form-label labeltxt" for="storedetails">Login Details</label>
                    <div class="lowerlower">
                        <div class="storedetailssetting lowerrow">
                            <label class="form-label" for="storemail">Email</label>
                            <input type="text" class="form-control" name="storemail" value="<?php echo $_SESSION['email'];?>" id="storemail">
                        </div>
                        <div class="storedetailssetting">
                            <label class="form-label" for="storecontact">Contact No.</label>
                            <input type="text" class="form-control" name="storecontact" value="<?php echo $_SESSION['contactno'];?>" id="storecontact">
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
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary greenbtn settingbtn">Submit</button>
                </div>
            </div>
            

            </form>
        </div>
        <?php } ?>
    </div>


</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var previewContainers = document.querySelectorAll('.addacclogo');
        previewContainers.forEach(function (previewContainer) {
            previewContainer.dataset.defaultBg = getComputedStyle(previewContainer).backgroundImage;
        });
    });

    function previewimg(input) {
        var fileInput = input;
        var previewContainers = document.querySelectorAll('.addacclogo');
        
        previewContainers.forEach(function (previewContainer) {
            var defaultBg = previewContainer.dataset.defaultBg;
            var file = fileInput.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.style.backgroundImage = "linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url('" + e.target.result + "')";
                    previewContainer.style.backgroundPosition = "center";
                    previewContainer.style.backgroundSize = "cover";
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.backgroundImage = defaultBg; 
            }
        });
    }
</script>
</html> 