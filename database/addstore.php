<?php
require_once("config.php");

$storename = trim($_POST['storename']);
$storedescription = $_POST['storedescription'];
$storestatus = trim($_POST['storestatus']);
$ownerfname = trim($_POST['ownerfname']); 
$ownermname = trim($_POST['ownermname']); 
$ownerlname = trim($_POST['ownerlname']); 
$ownercontact = trim($_POST['ownercontact']); 
$owneremail = trim($_POST['owneremail']); 
$ownerpassword = trim($_POST['ownerpassword']);

$storepic = $_FILES['storepic']['name'];
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
    $stmt = $pdo->prepare("INSERT INTO store (name, description, pic) VALUES (:storename, :storedescription, :storepic)");
    $stmt->bindParam(':storename', $storename);
    $stmt->bindParam(':storedescription', $storedescription);
    $stmt->bindParam(':storepic', $storepic);
    $stmt->execute();
    $lastInsertedId = $pdo->lastInsertId();

    $hashedpassword = password_hash($ownerpassword, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO staff (storeid, fname, lname, mname, contactno, email, password, role) VALUES (:storeid, :ownerfname, :ownerlname, :ownermname, :ownercontact, :owneremail, :ownerpassword, 'Owner')");
    $stmt->bindParam(':storeid', $lastInsertedId);
    $stmt->bindParam(':ownerfname', $storedescription);
    $stmt->bindParam(':ownerlname', $ownerlname);
    $stmt->bindParam(':ownermname', $ownermname);
    $stmt->bindParam(':ownercontact', $ownercontact);
    $stmt->bindParam(':owneremail', $owneremail);
    $stmt->bindParam(':ownerpassword', $hashedpassword);
    $stmt->execute();

    header('location: ../superadmin/accounts.php');
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
