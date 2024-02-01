<?php
    require_once('config.php');
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

    session_destroy();
    header('Location: ../kiosk/stores.php');
?>