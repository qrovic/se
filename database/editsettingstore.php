<?php
require_once("config.php");

$storeid = trim($_SESSION['storeid']);
$storename = trim($_POST['storename']);
$storedescription = $_POST['storedescription'];

$ownercontact = trim($_POST['storecontact']); 
$owneremail = trim($_POST['storemail']); 

$owneroldpassword = trim($_POST['storeoldpass']);
$ownernewpassword = trim($_POST['storenewpass']);

$hashedNewPassword = password_hash($ownernewpassword, PASSWORD_DEFAULT);

if (isset($_FILES['storepicsetting'])){
    $storepic = $_FILES['storepicsetting']['name'];
}else{
    $storepic = $_POST['storepicbackup'];
}


if (isset($_FILES["storepicsetting"]) && $_FILES["storepicsetting"]["error"] == 0) {
    $destinationFolder = "../resources/";
    $tempName = $_FILES["storepicsetting"]["tmp_name"];
    $destinationPath = $destinationFolder . $_FILES["storepicsetting"]["name"];
    if (move_uploaded_file($tempName, $destinationPath)) {
        echo "okiiiii";
    } else {
        echo "di okay";
    }
} else {
    echo "di okayy";
}

try {
    $stmt = $pdo->prepare("SELECT password FROM staff WHERE storeid = :storeid");
    $stmt->bindParam(':storeid', $storeid);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if (password_verify($owneroldpassword, $row['password'])) {
        $stmt = $pdo->prepare("UPDATE store SET name = :storename, description = :storedescription, pic = :storepic WHERE id = :storeid");
        $stmt->bindParam(':storeid', $storeid);
        $stmt->bindParam(':storename', $storename);
        $stmt->bindParam(':storedescription', $storedescription);
        $stmt->bindParam(':storepic', $storepic);
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE staff SET contactno = :ownercontact, email = :owneremail, password = :ownerpassword WHERE storeid = :storeid");
        $stmt->bindParam(':storeid', $storeid);
        $stmt->bindParam(':ownercontact', $ownercontact);
        $stmt->bindParam(':owneremail', $owneremail);
        $stmt->bindParam(':ownerpassword', $hashedNewPassword);
        $stmt->execute();

        header('Location: ../login/login.php');
        exit(); 
    } else {
        $_SESSION['settingerror'] = "Old password is incorrect.";
        header('Location: ../store/settings.php');
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
