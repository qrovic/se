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
$lastcustomerid = $stmt->fetchColumn()+1;

#cartcount
if (isset($_SESSION['orderid'])){
    $sqltotalcartcount = "SELECT COUNT(*) FROM cart WHERE customerid = :orderid";
    $stmt = $pdo->prepare($sqltotalcartcount);
    $stmt->bindParam(':orderid', $_SESSION['orderid'], PDO::PARAM_INT);
    $stmt->execute();
    $totalcartcount = $stmt->fetchColumn();
}



# Fetch total count of stores
$sqltotalstorescount = "SELECT COUNT(*) FROM store";
$resulttotalstorescount = $pdo->query($sqltotalstorescount);
$totalstorescount = $resulttotalstorescount->fetchColumn();

# Fetch count of online stores
$sqlonlinestorescount = "SELECT COUNT(*) FROM store WHERE status='online'";
$resultonlinestorescount = $pdo->query($sqlonlinestorescount);
$onlinestorescount = $resultonlinestorescount->fetchColumn();

# Store filter based on item search term
if (isset($_POST['search'])) {
    $searchterm = $_POST['search'];

    $sqlstorefilter = "SELECT store.name AS store_name, store.pic AS store_pic FROM store JOIN item ON item.storeid = store.id WHERE item.name LIKE :searchterm OR store.name LIKE :searchterm";
    $stmt = $pdo->prepare($sqlstorefilter);
    $stmt->bindParam(':searchterm', $searchterm, PDO::PARAM_STR);
    $stmt->execute();
    $filteredstores = $stmt->fetchAll();

    $sqlstorefiltercount = "SELECT COUNT(*) FROM store JOIN item ON item.storeid = store.id WHERE item.name LIKE :searchterm OR store.name LIKE :searchterm";
    $stmt = $pdo->prepare($sqlstorefiltercount);
    $stmt->bindParam(':searchterm', $searchterm, PDO::PARAM_STR);
    $stmt->execute();
    $filteredstorescount = $stmt->fetchColumn();
    
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
    $storename = $_POST['storename'];
    $itemsearch = '%'.$_POST['itemsearch'].'%';

    $sqlstoremenufilter = "SELECT item.name AS item_name, store.name AS store_name, item.pic AS item_pic, store.pic AS store_pic FROM item LEFT JOIN store ON item.storeid = store.id WHERE item.name LIKE :searchterm AND store.name = :storename";
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


