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
        
        $sqlitempriceid = "SELECT id, stock FROM itemprice WHERE size = :menusize AND variant = :menuvariation AND itemid = :itemid";
        $stmt = $pdo->prepare($sqlitempriceid);
        $stmt->bindParam(':menusize', $itemsizes[$i]);
        $stmt->bindParam(':menuvariation', $itemvariants[$i]);
        $stmt->bindParam(':itemid', $itemids[$i]);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stock = $row['stock'];

        if ($quantities[$i] > $stock) {
            echo '<div style="text-align: center; margin-top: 20px; color: red;">Quantity exceeds available stock, please checkout again. Thank you!</div>';
            echo '<meta http-equiv="refresh" content="5;url=../kiosk/cart.php">';
            exit;
        }
        
        $itempriceid = $row['id'];

        $stmt = $pdo->prepare("INSERT INTO orderitems (customerid, itempriceid, quantity) VALUES (:customerid, :itempriceid, :quantity) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)");
        $stmt->bindParam(':customerid', $customerid);
        $stmt->bindParam(':itempriceid', $itempriceid);
        $stmt->bindParam(':quantity', $quantities[$i]);
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE itemprice SET stock=stock-:quantity WHERE id=:itempriceid");
        $stmt->bindParam(':itempriceid', $itempriceid);
        $stmt->bindParam(':quantity', $quantities[$i]);
        $stmt->execute();

    }
    header('Location: ../kiosk/orderconfirmed.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

</body>
</html>