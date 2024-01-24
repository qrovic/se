<?php
require_once("config.php");

$storeid = trim($_POST['storename']);
$itemnames = $_POST['storedescription'];
$itemcategory = trim($_POST['category']);
$itempic = $_FILES['itempic']['name'];

$itemsizes = trim($_POST['itemsize']); 
$itemvariants = trim($_POST['itemvariant']); 
$itemstocks = trim($_POST['itemstock']); 
$itemprices = trim($_POST['itemprice']); 


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
    $stmt = $pdo->prepare("INSERT INTO item (name, description, status, pic) VALUES (:storename, :storedescription, :storestatus, :storepic)");
    $stmt->bindParam(':storename', $storename);
    $stmt->bindParam(':storedescription', $storedescription);
    $stmt->bindParam(':storestatus', $storestatus);
    $stmt->bindParam(':storepic', $storepic);
    $stmt->execute();
    $lastInsertedId = $pdo->lastInsertId();

    for ($i = 0; $i < count($POST['itemprice']); $i++) {

        $itemsize = $itemsizes[$i];
        $itemvariant = $itemvariants[$i];
        $itemstock = $itemstocks[$i];
        $itemprice = $itemprices[$i];

        $stmt = $pdo->prepare("INSERT INTO itemprice (storeid, fname, lname, mname, contactno, email, address, role) VALUES (:storeid, :ownerfname, :ownerlname, :ownermname, :ownercontact, :owneremail, :owneraddress, 'Owner')");
        $stmt->bindParam(':storeid', $lastInsertedId);
        $stmt->bindParam(':ownerfname', $storedescription);
        $stmt->bindParam(':ownerlname', $ownerlname);
        $stmt->bindParam(':ownermname', $ownermname);
        $stmt->bindParam(':ownercontact', $ownercontact);
        $stmt->bindParam(':owneremail', $owneremail);
        $stmt->bindParam(':owneraddress', $owneraddress);
        $stmt->execute();
    }
    header('location: ../superadmin/store.php');
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
