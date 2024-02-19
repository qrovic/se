
<!DOCTYPE html>
<html lang="en">
<body>
    <?php
        $currentpage='settings';
        require_once('../include/sidebarstore.php');
    ?>
    <div class="right storeright">
        <p class="stafftxt">Settings</p>
        <div class="setting">
            <div class="formsetting">
                <div class="uppersetting">
                    <div class="addacclogo editstorelogo" style="background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url('<?php echo "../resources/" . $storewowners['pic']; ?>'); background-position: center; background-size: cover;">
                        <label for="file" class="btn uploadbtn"><i class='bx bx-upload'></i>Upload</label>
                        <input id="file" name="storepic" hidden type="file" onchange="previewimg(this);">
                    </div>
                    <div class="leftupper">
                        <label class="form-label labeltxt" for="storedetails">Store Details</label>
                        <div class="storedetailssetting">
                            <label class="form-label" for="storename">Store Name</label>
                            <input type="text" class="form-control" name="storename" id="storename">
                        </div>
                        <div class="storedetailssetting">
                            <label class="form-label" for="storedescription">Store Description</label>
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