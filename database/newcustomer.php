<?php
    require_once('config.php');
    if (!isset($_SESSION)){
        session_start();
    }
    if (!isset($_SESSION['orderid'])){
        if(isset($lastcustomerid)){
        $customerid=$lastcustomerid+1;
        }
        $stmt = $pdo->prepare("SELECT id FROM customer WHERE id = :customerid");
        $stmt->bindParam(':customerid', $customerid);
        $stmt->execute();
        if (!$stmt->fetchColumn()) {
            //if cosutomer doesnt exists then add
            $stmt = $pdo->prepare("INSERT INTO customer (id) VALUES (:customerid)");
            $stmt->bindParam(':customerid', $customerid);
            $stmt->execute();
        }
    }

    if(!isset($_SESSION['orderid'])){
        $_SESSION['orderid']=$customerid;
    }
?>
