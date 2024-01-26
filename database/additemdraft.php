<?php
require_once("config.php");

$storeid = trim($_POST['storeid']);
$itemname = $_POST['itemname'];
$itemcategory = trim($_POST['itemcategory']);
$itempic = $_FILES['itempic']['name'];

if (isset($_FILES["itempic"]) && $_FILES["itempic"]["error"] == 0) {
    $destinationFolder = "../resources/";
    $tempName = $_FILES["itempic"]["tmp_name"];
    $destinationPath = $destinationFolder . $_FILES["itempic"]["name"];
    if (move_uploaded_file($tempName, $destinationPath)) {
        echo "okiiiii";
    } else {
        echo "di okay";
    }
} else {
    echo "di okayy";
}


try {
    $stmt = $pdo->prepare("INSERT INTO item (storeid, name, category, pic) VALUES (:storeid, :itemname, :itemcategory, :itempic)");
    $stmt->bindParam(':storeid', $storeid);
    $stmt->bindParam(':itemname', $itemname);
    $stmt->bindParam(':itemcategory', $itemcategory);
    $stmt->bindParam(':itempic', $itempic);
    $stmt->execute();
    $lastInsertedId = $pdo->lastInsertId();

    header('location: ../store/additemdraft.php');
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
