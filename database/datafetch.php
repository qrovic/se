<?php
require_once("config.php");
if(!isset($_SESSION)){
    session_start();
}
#fetch all stores
$sqlsalltores = "SELECT * FROM store";
$stmt = $pdo->prepare($sqlsalltores); 
$stmt->execute();  
$allstores = $stmt->fetchAll();

#fetch store w/ owner
$sqlstorewowner = "SELECT * FROM store JOIN staff ON store.id=staff.storeid WHERE role='Owner'";
$stmt = $pdo->prepare($sqlstorewowner); 
$stmt->execute();  
$storewowner = $stmt->fetchAll();

#get customerid
$sqllastcustomerid = "SELECT max(id) FROM customer";
$stmt = $pdo->prepare($sqllastcustomerid); 
$stmt->execute();  
$lastcustomerid = $stmt->fetchColumn();

#cartcount
if (isset($_SESSION['orderid'])){
    $sqltotalcartcount = "SELECT COUNT(*) FROM cart WHERE customerid = :orderid";
    $stmt = $pdo->prepare($sqltotalcartcount);
    $stmt->bindParam(':orderid', $_SESSION['orderid'], PDO::PARAM_INT);
    $stmt->execute();
    $totalcartcount = $stmt->fetchColumn();
    
}

#fetch total count of stores
$sqltotalstorescount = "SELECT COUNT(*) FROM store";
$resulttotalstorescount = $pdo->query($sqltotalstorescount);
$totalstorescount = $resulttotalstorescount->fetchColumn();

#fetch count of online stores
$sqlonlinestorescount = "SELECT COUNT(*) FROM store WHERE status='online'";
$resultonlinestorescount = $pdo->query($sqlonlinestorescount);
$onlinestorescount = $resultonlinestorescount->fetchColumn();

#store filter based on item search term
if (isset($_POST['search'])) {
    $searchterm = "%".$_POST['search']."%";

    $sqlstorefilter = "SELECT DISTINCT store.name AS store_name, store.id AS store_id, store.pic AS store_pic FROM store RIGHT JOIN item ON item.storeid = store.id WHERE item.name LIKE :searchterm";
    $stmt = $pdo->prepare($sqlstorefilter);
    $stmt->bindParam(':searchterm', $searchterm, PDO::PARAM_STR);
    $stmt->execute();
    $filteredstores = $stmt->fetchAll();

    $sqlstorefiltercount = "SELECT DISTINCT COUNT(DISTINCT store.id) FROM store JOIN item ON item.storeid = store.id WHERE item.name LIKE :searchterm;";
    $stmt = $pdo->prepare($sqlstorefiltercount);
    $stmt->bindParam(':searchterm', $searchterm, PDO::PARAM_STR);
    $stmt->execute();
    $filteredstorescount = $stmt->fetchColumn();
    
}

try {
    // fetch cart details 
    if (isset($_SESSION['orderid'])) {
        $orderid = $_SESSION['orderid'];
        $itemname=$cartdetail['itemname'];
        $cartstoreids=$cartstore['cartstoreid'];
        //fetch categories
        $sqlcategories = "SELECT DISTINCT category FROM cart LEFT JOIN itemprice ON itemprice.id=cart.itempriceid JOIN item ON item.id=itemprice.itemid JOIN store ON item.storeid=store.id WHERE store.name=:storename";
        $stmtcategories = $pdo->prepare($sqlcategories);
        $stmtcategories->bindParam(':storename', $storename, PDO::PARAM_STR);
        $stmtcategories->execute();
        $categories = $stmtcategories->fetchAll();

        $sqlitemvariants = "SELECT DISTINCT itemprice.variant
        FROM itemprice JOIN item ON item.id=itemprice.itemid
        WHERE item.id IN (
            SELECT item.id
            FROM item
            JOIN itemprice ON item.id = itemprice.itemid
            JOIN cart ON itemprice.id = cart.itempriceid
            WHERE cart.customerid = :orderid AND item.name=:itemname);";
        $stmtvariant = $pdo->prepare($sqlitemvariants);
        $stmtvariant->bindParam(':orderid', $orderid, PDO::PARAM_STR);
        $stmtvariant->bindParam(':itemname', $itemname, PDO::PARAM_STR);
        $stmtvariant->execute();
        $itemvariants = $stmtvariant->fetchAll();

        $sqlitemsizes = "SELECT DISTINCT itemprice.size
        FROM itemprice JOIN item ON item.id=itemprice.itemid
        WHERE item.id IN (
            SELECT item.id
            FROM item
            JOIN itemprice ON item.id = itemprice.itemid
            JOIN cart ON itemprice.id = cart.itempriceid
            WHERE cart.customerid = :orderid AND item.name=:itemname);";
        $stmtsize = $pdo->prepare($sqlitemsizes);
        $stmtsize->bindParam(':orderid', $orderid, PDO::PARAM_STR);
        $stmtsize->bindParam(':itemname', $itemname, PDO::PARAM_STR);
        $stmtsize->execute();
        $itemsizes = $stmtsize->fetchAll();
        
        // fetch cart details
        $sqlcartdetails = "SELECT cart.customerid AS customerid, itemprice.id AS itempriceid, itemprice.size AS itemsize, itemprice.variant AS itemvariant, itemprice.price AS itemprice, item.category AS itemcategory, item.name AS itemname, itemprice.itemid AS itemid, quantity AS quantity FROM cart JOIN itemprice ON itemprice.id=cart.itempriceid JOIN item ON itemprice.itemid=item.id WHERE cart.customerid = :orderid AND item.storeid= :cartstoreid";
        $stmt = $pdo->prepare($sqlcartdetails);
        $stmt->bindParam(':orderid', $orderid, PDO::PARAM_STR);
        $stmt->bindParam(':cartstoreid', $cartstoreids, PDO::PARAM_STR);
        $stmt->execute();
        $cartdetails = $stmt->fetchAll();
        
        // fetch cart details
        $sqlcartstore = "SELECT DISTINCT item.storeid AS cartstoreid, store.name AS cartstorename FROM cart JOIN itemprice ON itemprice.id=cart.itempriceid JOIN item ON itemprice.itemid=item.id JOIN store ON store.id=item.storeid WHERE cart.customerid = :orderid";
        $stmt = $pdo->prepare($sqlcartstore);
        $stmt->bindParam(':orderid', $orderid, PDO::PARAM_STR);
        $stmt->execute();
        $cartstores = $stmt->fetchAll();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

#fetch drinks items 
if (isset($_SESSION['storename'])) {
    $storename = $_SESSION['storename'];

    #fetch categories
    $sqlcategories = "SELECT DISTINCT category FROM item LEFT JOIN store ON item.storeid=store.id WHERE store.name=:storename";
    $stmtcategories = $pdo->prepare($sqlcategories);
    $stmtcategories->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmtcategories->execute();
    $categories = $stmtcategories->fetchAll();

    $sqldrinks = "SELECT item.name AS item_name, item.id AS item_id, store.name AS store_name, item.pic AS item_pic, store.pic AS store_pic FROM item JOIN store ON item.storeid = store.id WHERE category='Drinks' AND store.name=:storename";
    $stmtdrinks = $pdo->prepare($sqldrinks);
    $stmtdrinks->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmtdrinks->execute();
    $Drinks = $stmtdrinks->fetchAll();

    $sqlmeals = "SELECT item.name AS item_name, item.id AS item_id, store.name AS store_name, item.pic AS item_pic, store.pic AS store_pic FROM item JOIN store ON item.storeid = store.id WHERE category='Meals' AND store.name=:storename";
    $stmtmeals = $pdo->prepare($sqlmeals);
    $stmtmeals->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmtmeals->execute();
    $Meals = $stmtmeals->fetchAll();

    $sqlsnacks = "SELECT item.name AS item_name, item.id AS item_id, store.name AS store_name, item.pic AS item_pic, store.pic AS store_pic FROM item JOIN store ON item.storeid = store.id WHERE category='Snacks' AND store.name=:storename";
    $stmtsnacks = $pdo->prepare($sqlsnacks);
    $stmtsnacks->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmtsnacks->execute();
    $Snacks = $stmtsnacks->fetchAll();

    $sqldesserts = "SELECT item.name AS item_name, item.id AS item_id, store.name AS store_name, item.pic AS item_pic, store.pic AS store_pic FROM item JOIN store ON item.storeid = store.id WHERE category='Desserts' AND store.name=:storename";
    $stmtdesserts = $pdo->prepare($sqldesserts);
    $stmtdesserts->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmtdesserts->execute();
    $Desserts = $stmtdesserts->fetchAll();

    $sqlcombos = "SELECT item.name AS item_name, item.id AS item_id, store.name AS store_name, item.pic AS item_pic, store.pic AS store_pic FROM item JOIN store ON item.storeid = store.id WHERE category='Combos' AND store.name=:storename";
    $stmtcombos = $pdo->prepare($sqlcombos);
    $stmtcombos->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmtcombos->execute();
    $Combos = $stmtcombos->fetchAll();
}

#fetch all stores with items and are active
$sqlstores = "SELECT store.*, COUNT(item.category) AS category_count FROM store LEFT JOIN item ON store.id = item.storeid WHERE store.status = 'Online' GROUP BY store.id HAVING category_count >= 1;";
$stmt = $pdo->prepare($sqlstores); 
$stmt->execute();  
$stores = $stmt->fetchAll();

if (isset($_POST['storename']) && isset($_POST['itemsearch'])) {
    try {
    $storename = $_SESSION['storename'];
    $itemsearch = "%".$_POST['itemsearch'].'%';

    $sqlstoremenufilter = "SELECT item.name AS item_name, item.id AS item_id, store.name AS store_name, item.pic AS item_pic, store.pic AS store_pic FROM item LEFT JOIN store ON item.storeid = store.id WHERE item.name LIKE :searchterm AND store.name = :storename";
    $stmt = $pdo->prepare($sqlstoremenufilter);
    $stmt->bindParam(':searchterm', $itemsearch, PDO::PARAM_STR);
    $stmt->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmt->execute();
    $filteredstoremenu = $stmt->fetchAll();

    $sqlstoremenufiltercount = "SELECT COUNT(*) FROM item LEFT JOIN store ON item.storeid=store.id WHERE item.name LIKE :searchterm AND store.name = :storename";
    $stmt = $pdo->prepare($sqlstoremenufiltercount);
    $stmt->bindParam(':searchterm', $itemsearch , PDO::PARAM_STR);
    $stmt->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmt->execute();
    $filteredstoremenucount = $stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}
?>


