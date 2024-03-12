<?php
    require_once('../database/config.php');
    session_start();
    $customerid = $_SESSION['orderid'];

    try { 
        $sql = "UPDATE customer SET status = 'cancelled' WHERE id = :customerid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':customerid', $customerid, PDO::PARAM_INT);
        $stmt->execute();
            echo "done";
        
    } catch (PDOException $e) {
        echo "Error updating customer status: " . $e->getMessage();
    }

    unset($_SESSION['orderid']);
    unset($customerid);
    header('Location: ../store/storecart.php');
?>