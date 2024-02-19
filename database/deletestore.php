<?php
require_once('../database/config.php');

try {
    if (isset($_POST['storeid'])) {
        $storeid = $_POST['storeid'];

        $sqlItem = "DELETE FROM item WHERE storeid = :storeid";
        $stmtItem = $pdo->prepare($sqlItem);
        $stmtItem->bindParam(':storeid', $storeid, PDO::PARAM_INT);
        
        $sqlStore = "DELETE FROM store WHERE id = :storeid";
        $stmtStore = $pdo->prepare($sqlStore);
        $stmtStore->bindParam(':storeid', $storeid, PDO::PARAM_INT);

        $stmtItem->execute();

        if ($stmtStore->execute()) {
            header('location: ../superadmin/accounts.php');
        } else {
            echo "Error deleting record from store table";
        }
    } else {
        echo "storeid not provided";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
