<?php
require_once("config.php");
require_once("datafetch.php");
if(!isset($_SESSION)){
    session_start();
}
$quantity = ($_POST['quantity']);
$menuvariation = ($_POST['menuvariation']);
$menusize = ($_POST['menusize']);
$itemid = ($_POST['menuid']);
$customerid=($_SESSION['orderid']);


try {
    $sqlitempriceid = "SELECT id FROM itemprice WHERE size = :menusize AND variant = :menuvariation AND itemid = :itemid";
    $stmt = $pdo->prepare($sqlitempriceid);
    $stmt->bindParam(':menusize', $menusize);
    $stmt->bindParam(':menuvariation', $menuvariation);
    $stmt->bindParam(':itemid', $itemid);
    
    $stmt->execute();
    
    $itempriceid = $stmt->fetchColumn();
    
    $stmt = $pdo->prepare("INSERT INTO cart (customerid, itempriceid, quantity) VALUES (:customerid, :itempriceid, :quantity) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)");
    $stmt->bindParam(':customerid', $customerid);
    $stmt->bindParam(':itempriceid', $itempriceid);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->execute();
    header('Location: ../kiosk/menu.php');
} catch (PDOException $e) {
    echo $itemid . $menusize . $menuvariation;
    echo "Error: " . $e->getMessage();
}
?>
