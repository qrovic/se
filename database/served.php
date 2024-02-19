<?php
require_once('../database/config.php');

$orderid = $_POST['storecustomerid'];
$storestoreid = $_SESSION['storestoreid'];

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("UPDATE orderitems JOIN itemprice ON orderitems.itempriceid = itemprice.id JOIN item ON item.id = itemprice.itemid JOIN store ON store.id = item.storeid SET orderitems.status = 'collect' WHERE orderitems.customerid = :orderid AND store.id = :storeid");
    $stmt->bindParam(':orderid', $orderid);
    $stmt->bindParam(':storeid', $storestoreid);
    $stmt->execute();

    $stmt = $pdo->prepare("UPDATE orders JOIN orderitems ON orderitems.customerid = orders.id SET orders.status = 'collect' WHERE orders.id = :orderid AND orders.storeid = :storeid");
    $stmt->bindParam(':orderid', $orderid);
    $stmt->bindParam(':storeid', $storestoreid);
    $stmt->execute();
   

    $pdo->commit();
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
