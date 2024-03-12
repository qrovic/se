<?php
require_once('../database/config.php');


try {
    if (isset($_POST['editstoreid'])) {
        $itemid = $_POST['editstoreid'];
        $stmt = $pdo->prepare("SELECT status FROM item WHERE id = :itemid");
        $stmt->bindParam(':itemid', $itemid);
        $stmt->execute();
        $currentStatus = $stmt->fetchColumn();

       
        $newStatus = ($currentStatus == 'Active') ? 'Inactive' : 'Active';

       
        $stmt = $pdo->prepare("UPDATE item SET status = :status WHERE id = :itemid");
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':itemid', $itemid);
        $stmt->execute();
        
        if ($stmt->execute()) {
            header('location: ../store/menus.php');
        } else {
            echo "Error editing record from store table";
        }
    } else {
        echo "storeid not provided";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
