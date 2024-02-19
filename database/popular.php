<?php
require_once("config.php");
if (!isset($_SESSION)) {
    session_start();
}
        $stmt = $pdo->prepare("SELECT id FROM store");
        $stmt->execute();
        $allstores = $stmt->fetchAll();
try {
    foreach($allstores as $allstore){
        $storeid=$allstore['id'];

        $stmt = $pdo->prepare("SELECT COUNT(orderitems.customerid) AS customercount, item.name AS item_name, item.id AS item_id, store.name AS store_name, item.pic AS item_pic, store.pic AS store_pic
        FROM item
        JOIN store ON item.storeid = store.id
        JOIN itemprice ON itemprice.itemid = item.id
        JOIN orderitems ON itemprice.id = orderitems.itempriceid
        WHERE DATE(orderitems.datetime) = CURDATE() AND store.id = :storeid
        GROUP BY item_name
        ORDER BY customercount DESC
        LIMIT 3;
        ");
        $stmt->bindParam(':storeid', $storeid);
        $stmt->execute();
        $Popular = $stmt->fetchAll();

        foreach ($Popular as $populars) {
            $itemid = $populars['item_id'];
            
            $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM popular WHERE itemid = :itemid AND DATE(date) = CURDATE()");
            $stmt_check->bindParam(':itemid', $itemid);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();
        
            if ($count == 0) {
                $stmt_insert = $pdo->prepare("INSERT INTO popular (itemid) VALUES (:itemid)");
                $stmt_insert->bindParam(':itemid', $itemid);
                $stmt_insert->execute();
            }
            $stmt_update = $pdo->prepare("UPDATE item SET category='Popular' WHERE id = :itemid");
            $stmt_update->bindParam(':itemid', $itemid);
            $stmt_update->execute();
        }
    }
    
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
