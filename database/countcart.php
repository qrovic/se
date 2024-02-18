<?php
session_start();
require_once '../database/config.php';
if (isset($_SESSION['orderid'])) {
    
    $sqltotalcartcount = "SELECT COUNT(*) FROM cart JOIN itemprice ON itemprice.id=cart.itempriceid WHERE customerid = :orderid AND itemprice.stock!=0";
    $stmt = $pdo->prepare($sqltotalcartcount);
    $stmt->bindParam(':orderid', $_SESSION['orderid'], PDO::PARAM_INT);
    $stmt->execute();
    $totalcartcount = $stmt->fetchColumn();

    echo json_encode(['totalcartcount' => $totalcartcount]);
} else {
    echo json_encode(['error' => 'Session orderid not set']);
}
?>
