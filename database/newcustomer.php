<?php
    require_once('config.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $ordertype = "cashier"; // Default value
    if (isset($_SESSION['type'])) {
        $ordertype = $_SESSION['type'];
    } else {
        $_SESSION['type'] = $ordertype;
    }

    if (!isset($_SESSION['orderid'])){
        if(isset($lastcustomerid)){
        $customerid=$lastcustomerid+1;
        }
        $stmt = $pdo->prepare("SELECT id FROM customer WHERE id = :customerid");
        $stmt->bindParam(':customerid', $customerid);
        $stmt->execute();
        if (!$stmt->fetchColumn()) {
            $stmt = $pdo->prepare("INSERT INTO customer (id, ordertype) VALUES (:customerid, :ordertype)");
            $stmt->bindParam(':customerid', $customerid);
            $stmt->bindParam(':ordertype', $ordertype);
            $stmt->execute();
        }        
    }

    if(!isset($_SESSION['orderid'])){
        $_SESSION['orderid']=$customerid;
    }
?>
