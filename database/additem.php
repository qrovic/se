<?php
require_once("config.php");

$storeid = ($_SESSION['storeid']);
$itemname = $_POST['itemname'];
$itemsizes = ($_POST['itemsizes2']);
$itemvariants = ($_POST['itemvariants2']); 
$itemcategory = trim($_POST['itemcategory']);
$itempic = $_POST['itempic'];
$itemstocks = ($_POST['itemstocks']); 
$itemprices = ($_POST['itemprices']); 


echo $storeid;
try {
    $stmt = $pdo->prepare("INSERT INTO item (storeid, name, category, pic, permcategory) VALUES (:storeid, :name, :category, :pic, :category)");
    $stmt->bindParam(':storeid', $storeid);
    $stmt->bindParam(':name', $itemname);
    $stmt->bindParam(':category', $itemcategory);
    $stmt->bindParam(':pic', $itempic);
    $stmt->execute();
    $lastInsertedId = $pdo->lastInsertId();

    $counter = 0;
    foreach ($itemvariants as $key => $variant) {
        echo "<br>";
        echo $variant;

        foreach ($itemsizes as $key1 => $size) {
            echo "<br>";
            echo $size;
            echo "<br>";

            $adjustedIndex = $counter % count($itemstocks);

            $itemprice = $itemprices[$adjustedIndex];
            $itemstock = $itemstocks[$adjustedIndex];

            echo $itemprice;
            echo $itemstock;

            $stmt = $pdo->prepare("INSERT INTO itemprice (itemid, variant, size, price, stock) VALUES (:itemid, :variant, :size, :price, :stock)");
            $stmt->bindParam(':itemid', $lastInsertedId);
            $stmt->bindParam(':variant', $variant);
            $stmt->bindParam(':size', $size); 
            $stmt->bindParam(':price', $itemprice); 
            $stmt->bindParam(':stock', $itemstock); 
            $stmt->execute();
            
            $counter++;
        }
        echo "<br>";
        echo "<br>";
    }


    header('location: ../store/menus.php');
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
