<?php
require_once("config.php");

$storename = trim($_POST['storename']);
$storedescription = $_POST['storedescription'];
$storestatus = trim($_POST['storestatus']);
$storepic = $_FILES['storepic']['name'];

$ownerfname = trim($_POST['ownerfname']); 
$ownermname = trim($_POST['ownermname']); 
$ownerlname = trim($_POST['ownerlname']); 
$ownercontact = trim($_POST['ownercontact']); 
$owneremail = trim($_POST['owneremail']); 
$owneraddress = trim($_POST['owneraddress']); 

if (isset($_FILES["storepic"]) && $_FILES["storepic"]["error"] == 0) {
    $destinationFolder = "../resources/";
    $tempName = $_FILES["storepic"]["tmp_name"];
    $destinationPath = $destinationFolder . $_FILES["storepic"]["name"];
    if (move_uploaded_file($tempName, $destinationPath)) {
        echo "okiiiii";
    } else {
        echo "di okay";
    }
} else {
    echo "di okayy";
}


try {
    $stmt = $pdo->prepare("INSERT INTO store (name, description, status, pic) VALUES (:storename, :storedescription, :storestatus, :storepic)");
    $stmt->bindParam(':storename', $storename);
    $stmt->bindParam(':storedescription', $storedescription);
    $stmt->bindParam(':storestatus', $storestatus);
    $stmt->bindParam(':storepic', $storepic);
    $stmt->execute();
    $lastInsertedId = $pdo->lastInsertId();

    
    $stmt = $pdo->prepare("INSERT INTO staff (storeid, fname, lname, mname, contactno, email, address, role) VALUES (:storeid, :ownerfname, :ownerlname, :ownermname, :ownercontact, :owneremail, :owneraddress, 'Owner')");
    $stmt->bindParam(':storeid', $lastInsertedId);
    $stmt->bindParam(':ownerfname', $storedescription);
    $stmt->bindParam(':ownerlname', $ownerlname);
    $stmt->bindParam(':ownermname', $ownermname);
    $stmt->bindParam(':ownercontact', $ownercontact);
    $stmt->bindParam(':owneremail', $owneremail);
    $stmt->bindParam(':owneraddress', $owneraddress);
    $stmt->execute();

    header('location: ../superadmin/store.php');
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
