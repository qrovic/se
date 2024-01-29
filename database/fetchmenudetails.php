<?php
require_once('../database/config.php');
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['storeid'])){
    $menuid = $nope['item_id'];
    $storeid = $_SESSION['storeid'];
    
    $sqlmenudetails = "SELECT * FROM item RIGHT JOIN itemprice ON item.id = itemprice.itemid RIGHT JOIN store ON store.id = item.storeid WHERE item.id = :menuid AND item.storeid = :storeid";
    $stmt = $pdo->prepare($sqlmenudetails);
    $stmt->bindParam(':menuid', $menuid, PDO::PARAM_STR);
    $stmt->bindParam(':storeid', $storeid, PDO::PARAM_STR);
    $stmt->execute();
    $menudetails = $stmt->fetchAll();
    
    $sqlmenuvariant = "SELECT DISTINCT variant as menuvariety FROM itemprice LEFT JOIN item ON item.id = itemprice.itemid RIGHT JOIN store ON store.id = item.storeid WHERE item.id = :menuid AND item.storeid = :storeid";
    $stmt = $pdo->prepare($sqlmenuvariant);
    $stmt->bindParam(':menuid', $menuid, PDO::PARAM_STR);
    $stmt->bindParam(':storeid', $storeid, PDO::PARAM_STR);
    $stmt->execute();
    $menuvariant = $stmt->fetchAll();
    
    $sqlmenusize = "SELECT DISTINCT size as menusize FROM itemprice LEFT JOIN item ON item.id = itemprice.itemid RIGHT JOIN store ON store.id = item.storeid WHERE item.id = :menuid AND item.storeid = :storeid";
    $stmt = $pdo->prepare($sqlmenusize);
    $stmt->bindParam(':menuid', $menuid, PDO::PARAM_STR);
    $stmt->bindParam(':storeid', $storeid, PDO::PARAM_STR);
    $stmt->execute();
    $menusize = $stmt->fetchAll();
}
if(isset($_POST['variety'])){
    $selectedVariety = $_POST['variety'];
    $selectedSize = $_POST['size'];
    $storeid=$_POST['storeid'];
    $menuid=$_POST['menuid'];

    $query = "SELECT price FROM itemprice WHERE variant = :variety AND size = :size AND itemid = :menuid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':variety', $selectedVariety);
    $stmt->bindParam(':size', $selectedSize);
    $stmt->bindParam(':menuid', $menuid);
    try {
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            echo $result['price'];
        } else {
            echo "0";
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    $pdo = null;
}


?>
