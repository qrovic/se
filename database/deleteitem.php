<?php
require_once('../database/config.php');

try {
    if (isset($_POST['editstoreid'])) {
        $itemid = $_POST['editstoreid'];

        $sqlitemprice = "DELETE FROM itemprice WHERE itemid = :itemid";
        $stmtitemprice = $pdo->prepare($sqlitemprice);
        $stmtitemprice->bindParam(':itemid', $itemid, PDO::PARAM_INT);
        
        $sqlitem = "DELETE FROM item WHERE id = :itemid";
        $stmtitem = $pdo->prepare($sqlitem);
        $stmtitem->bindParam(':itemid', $itemid, PDO::PARAM_INT);

        $stmtitemprice->execute();

        if ($stmtitem->execute()) {
            header('location: ../store/menus.php');
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
