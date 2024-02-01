<?php
require_once("config.php");

$storeid = ($_POST['storeid']);
$itemname = $_POST['itemname'];
$itemsizes = ($_POST['itemsizes2']);
$itemvariants = ($_POST['itemvariants2']); 
$itemcategory = trim($_POST['itemcategory']);
$itempic = $_FILES['itempic']['name'];
$itemstocks = ($_POST['itemstocks']); 
$itemprices = ($_POST['itemprices']); 


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
    $stmt = $pdo->prepare("INSERT INTO item (storeid, name, category, pic) VALUES (:storeid, :name, :category, :pic)");
    $stmt->bindParam(':storeid', $storeid);
    $stmt->bindParam(':name', $itemname);
    $stmt->bindParam(':category', $itemcategory);
    $stmt->bindParam(':pic', $itempic);
    $stmt->execute();
    $lastInsertedId = $pdo->lastInsertId();

    foreach ($itemvariants as $variant) {
        
        foreach ($itemsizes as $i => $size) {
            echo $size."";
            $itemprice=$itemprices[$i];
            $itemstock=$itemstocks[$i];
            /*$stmt = $pdo->prepare("INSERT INTO itemprice (itemid, variant, size, price, stock) VALUES (:itemid, :variant, :size, :price, :stock)");
            $stmt->bindParam(':itemid', $lastInsertedId);
            $stmt->bindParam(':variant', $variant);
            $stmt->bindParam(':size', $size); 
            $stmt->bindParam(':price', $itemprice); 
            $stmt->bindParam(':stock', $itemstock); 
            $stmt->execute();*/
            echo "price: ".$itemprice." stock: ".$itemstock;
            
        }
    }

    //header('location: ../superadmin/store.php');
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
