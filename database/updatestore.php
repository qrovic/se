<?php
require_once("config.php");

$storeid = trim($_POST['storeid']);  
$storename = trim($_POST['storename']);
$storedescription = $_POST['storedescription'];

$ownerfname = trim($_POST['ownerfname']); 
$ownermname = trim($_POST['ownermname']); 
$ownerlname = trim($_POST['ownerlname']); 
$ownercontact = trim($_POST['ownercontact']); 
$owneremail = trim($_POST['owneremail']); 

$ownerpassword = trim($_POST['ownerpassword']);

$storepic = $_FILES['storepicedit']['name'];

if (isset($_FILES["storepicedit"]) && $_FILES["storepicedit"]["error"] == 0) {
    $destinationFolder = "../resources/";
    $tempName = $_FILES["storepicedit"]["tmp_name"];
    $destinationPath = $destinationFolder . $_FILES["storepicedit"]["name"];
    if (move_uploaded_file($tempName, $destinationPath)) {
        echo "okiiiii";
    } else {
        echo "di okay";
    }
} else {
    echo "di okayy";
}

try {
    $stmt = $pdo->prepare("UPDATE store SET name = :storename, description = :storedescription, pic = :storepic WHERE id = :storeid");
    $stmt->bindParam(':storeid', $storeid);
    $stmt->bindParam(':storename', $storename);
    $stmt->bindParam(':storedescription', $storedescription);
    $stmt->bindParam(':storepic', $storepic);
    $stmt->execute();

    $stmt = $pdo->prepare("UPDATE staff SET fname = :ownerfname, lname = :ownerlname, mname = :ownermname, contactno = :ownercontact, email = :owneremail, password = :ownerpassword WHERE storeid = :storeid");
    $stmt->bindParam(':storeid', $storeid);
    $stmt->bindParam(':ownerfname', $storedescription);
    $stmt->bindParam(':ownerlname', $ownerlname);
    $stmt->bindParam(':ownermname', $ownermname);
    $stmt->bindParam(':ownercontact', $ownercontact);
    $stmt->bindParam(':owneremail', $owneremail);
    $stmt->bindParam(':ownerpassword', $ownerpassword);
    $stmt->execute();

    //header('Location: ../superadmin/accounts.php');
    exit(); 
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
