<?php
require_once("config.php");
require_once("datafetch.php");

if (!isset($_SESSION)) {
    session_start();
}

$storeids = $_POST['storeid'];
$customerid = $_POST['orderid'];
$itemids = $_POST['itemid'];
$itemvariants = $_POST['itemvariant'];
$itemsizes = $_POST['itemsize'];
$quantities = $_POST['quantity'];

try {
    $count = count($itemids);

    for ($i = 0; $i < $count; $i++) {
        
        $sqlitempriceid = "SELECT id FROM itemprice WHERE size = :menusize AND variant = :menuvariation AND itemid = :itemid";
        $stmt = $pdo->prepare($sqlitempriceid);
        $stmt->bindParam(':menusize', $itemsizes[$i]);
        $stmt->bindParam(':menuvariation', $itemvariants[$i]);
        $stmt->bindParam(':itemid', $itemids[$i]);

        $stmt->execute();

        $itempriceid = $stmt->fetchColumn();

        $stmt = $pdo->prepare("INSERT INTO orders (customerid, itempriceid, quantity, status) VALUES (:customerid, :itempriceid, :quantity, :status) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)");
        $stmt->bindParam(':customerid', $customerid);
        $stmt->bindParam(':itempriceid', $itempriceid);
        $stmt->bindParam(':quantity', $quantities[$i]);
        $stmt->bindParam(':status', $status); 
        $stmt->execute();
    }
    header('Location: ../kiosk/orderconfirmed.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>