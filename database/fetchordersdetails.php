<?php
require_once('../database/config.php');

if (isset($_SESSION['storestoreid'])) {
    $storestoreid=$_SESSION['storestoreid'];

    $sqlordertopaycount = "SELECT COUNT(DISTINCT orderitems.customerid) FROM orderitems 
                        LEFT JOIN itemprice ON orderitems.itempriceid = itemprice.id 
                        JOIN item ON itemprice.itemid = item.id 
                        WHERE orderitems.status = 'to_pay' AND item.storeid = :storestoreid1";

    $stmt = $pdo->prepare($sqlordertopaycount);
    $stmt->bindParam(':storestoreid1', $storestoreid, PDO::PARAM_INT);
    $stmt->execute();
    $ordertopaycount = $stmt->fetchColumn();

    $sqlorderpaidcount = "SELECT COUNT(DISTINCT orderitems.customerid) FROM orderitems 
    LEFT JOIN itemprice ON orderitems.itempriceid = itemprice.id 
    JOIN item ON itemprice.itemid = item.id 
    WHERE orderitems.status = 'paid' AND item.storeid = :storestoreid2";

    $stmt = $pdo->prepare($sqlorderpaidcount);
    $stmt ->bindParam(':storestoreid2', $storestoreid, PDO::PARAM_INT);
    $stmt->execute();
    $orderpaidcount = $stmt->fetchColumn();

    $sqlordertoservecount = "SELECT COUNT(DISTINCT orderitems.customerid) FROM orderitems 
                        LEFT JOIN itemprice ON orderitems.itempriceid = itemprice.id 
                        JOIN item ON itemprice.itemid = item.id 
                        WHERE orderitems.status = 'paid' AND item.storeid = :storestoreid2";

    $stmt = $pdo->prepare($sqlordertoservecount);
    $stmt->bindParam(':storestoreid2', $storestoreid, PDO::PARAM_INT);
    $stmt->execute();
    $ordertoservecount = $stmt->fetchColumn();

    $sqlorderservedcount = "SELECT COUNT(DISTINCT orderitems.customerid) FROM orderitems 
    LEFT JOIN itemprice ON orderitems.itempriceid = itemprice.id 
    JOIN item ON itemprice.itemid = item.id 
    WHERE orderitems.status = 'collect' AND item.storeid = :storestoreid2";

    $stmt = $pdo->prepare($sqlorderservedcount);
    $stmt ->bindParam(':storestoreid2', $storestoreid, PDO::PARAM_INT);
    $stmt->execute();
    $orderservedcount = $stmt->fetchColumn();
    
    $sqlstoreorders = "SELECT orderitems.customerid AS customerid,SUM(itemprice.price * orderitems.quantity) AS totalprice, DATE_FORMAT(MAX(orderitems.datetime), '%H:%i') AS ordertime FROM orderitems JOIN itemprice ON itemprice.id = orderitems.itempriceid JOIN item ON itemprice.itemid = item.id WHERE storeid = :storestoreid and status='to_pay' GROUP BY orderitems.customerid";
    $stmt = $pdo->prepare($sqlstoreorders);
    $stmt->bindParam(':storestoreid', $storestoreid, PDO::PARAM_STR);
    $stmt->execute();
    $storeorders = $stmt->fetchAll();

    $sqlstoreorders = "SELECT orderitems.customerid AS customerid,SUM(itemprice.price * orderitems.quantity) AS totalprice, DATE_FORMAT(MAX(orderitems.datetime), '%h:%i %p') AS ordertime FROM orderitems JOIN itemprice ON itemprice.id = orderitems.itempriceid JOIN item ON itemprice.itemid = item.id WHERE storeid = :storestoreid and status='paid' GROUP BY orderitems.customerid";
    $stmt = $pdo->prepare($sqlstoreorders);
    $stmt->bindParam(':storestoreid', $storestoreid, PDO::PARAM_STR);
    $stmt->execute();
    $storeorderspaid = $stmt->fetchAll();

    $sqlcustomerstoreorder = "SELECT orderitems.customerid AS customerid, (itemprice.price * orderitems.quantity) AS totalprice,item.storeid AS storeid, itemprice.size AS itemsize, orderitems.datetime AS datetimes, itemprice.variant AS itemvariant, itemprice.price AS itemprice, item.category AS itemcategory, item.name AS itemname, quantity AS quantity FROM orderitems JOIN itemprice ON itemprice.id=orderitems.itempriceid JOIN item ON itemprice.itemid=item.id WHERE storeid = :storestoreid";
    $stmt = $pdo->prepare($sqlcustomerstoreorder);
    $stmt->bindParam(':storestoreid', $storestoreid, PDO::PARAM_STR);
    $stmt->execute();
    $customerstoreorder = $stmt->fetchAll();

    $sqlneworderidpaid = "SELECT MAX(DISTINCT orderitems.customerid) AS neworderid FROM orderitems LEFT JOIN itemprice ON orderitems.itempriceid = itemprice.id JOIN item ON itemprice.itemid = item.id WHERE orderitems.status = 'paid' AND item.storeid = :storestoreid";
    $stmt = $pdo->prepare($sqlneworderidpaid);
    $stmt->bindParam(':storestoreid', $storestoreid, PDO::PARAM_STR);
    $stmt->execute();
    $neworderidpaid = $stmt->fetchColumn();

    $sqlneworderid = "SELECT MAX(DISTINCT orderitems.customerid) AS neworderid FROM orderitems LEFT JOIN itemprice ON orderitems.itempriceid = itemprice.id JOIN item ON itemprice.itemid = item.id WHERE orderitems.status = 'to_pay' AND item.storeid = :storestoreid";
    $stmt = $pdo->prepare($sqlneworderid);
    $stmt->bindParam(':storestoreid', $storestoreid, PDO::PARAM_STR);
    $stmt->execute();
    $neworderid = $stmt->fetchColumn();

    $sqlstorequeuepreparing = "SELECT id AS customerid FROM orders WHERE storeid = :storestoreid AND status = 'paid'";
    $stmt = $pdo->prepare($sqlstorequeuepreparing);
    $stmt->bindParam(':storestoreid', $storestoreid, PDO::PARAM_STR);
    $stmt->execute();
    $storequeuepreparing = $stmt->fetchAll();

    $sqlstorequeuecollect = "SELECT id AS customerid FROM orders WHERE storeid = :storestoreid AND status = 'collect'";
    $stmt = $pdo->prepare($sqlstorequeuecollect);
    $stmt->bindParam(':storestoreid', $storestoreid, PDO::PARAM_STR);
    $stmt->execute();
    $storequeuecollect = $stmt->fetchAll();
    
    echo json_encode(['ordertoservecount' => $ordertoservecount,'orderservedcount' => $orderservedcount,'ordertopaycount' => $ordertopaycount, 'orderpaidcount' => $orderpaidcount, 'customerstoreorder' => $customerstoreorder, 'storeorders' => $storeorders, 'storeorderspaid' => $storeorderspaid, 'neworderid' => $neworderid, 'neworderidpaid' => $neworderidpaid, 'storequeuepreparing' => $storequeuepreparing, 'storequeuecollect' => $storequeuecollect]);
} else {
    echo json_encode(['error' => 'Session storestoreid not set']);
}
?>