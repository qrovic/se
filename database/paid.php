<?php
require_once('../database/config.php');
$change = $_POST['change'];
$orderid = $_POST['storecustomerid'];
$storestoreid = $_SESSION['storestoreid'];
$total = $_POST['total'];
$cash = $_POST['cash'];
$change = $cash - $total;

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("UPDATE orderitems JOIN itemprice ON orderitems.itempriceid = itemprice.id JOIN item ON item.id = itemprice.itemid JOIN store ON store.id = item.storeid SET orderitems.status = 'paid' WHERE orderitems.customerid = :orderid AND store.id = :storeid");
    $stmt->bindParam(':orderid', $orderid);
    $stmt->bindParam(':storeid', $storestoreid);
    $stmt->execute();

    $stmt = $pdo->prepare("INSERT INTO orders (id, storeid, total, cash, `change`, status) VALUES (:orderid, :storeid, :total, :cash, :change, 'paid')");
    $stmt->bindParam(':orderid', $orderid);
    $stmt->bindParam(':storeid', $storestoreid);
    $stmt->bindParam(':total', $total);
    $stmt->bindParam(':cash', $cash);
    $stmt->bindParam(':change', $change);
    $stmt->execute();

    $pdo->commit();
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
