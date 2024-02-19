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

#fetch superadmin staff
$sqlsuperadminstaffs = "SELECT store.name AS staffstorename, staff.id AS staffid, staff.storeid AS staffstoreid, staff.fname as stafffname, staff.lname as stafflname,staff.mname as staffmname, staff.contactno AS staffcontactno, staff.email as staffemail, staff.password as staffpassword, staff.role as staffrole FROM store right JOIN staff ON store.id=staff.storeid";
$stmt = $pdo->prepare($sqlsuperadminstaffs); 
$stmt->execute();  
$superadminstaffs = $stmt->fetchAll();

if (isset($_SESSION['storestoreid'])){
    $storeid=$_SESSION['storestoreid'];

    $sqlstorestaff = "SELECT store.id AS storeid, store.name AS staffstorename, staff.id AS staffid, staff.storeid AS staffstoreid, staff.fname as stafffname, staff.lname as stafflname,staff.mname as staffmname, staff.contactno AS staffcontactno, staff.email as staffemail, staff.password as staffpassword, staff.role as staffrole FROM store right JOIN staff ON store.id=staff.storeid WHERE storeid=:storeid";
    $stmt = $pdo->prepare($sqlstorestaff);
    $stmt->bindParam(':storeid', $storeid, PDO::PARAM_INT);
    $stmt->execute();
    $storestaff = $stmt->fetchAll();
    
}
if (isset($_SESSION['storestoreid'])){
    $storeid=$_SESSION['storestoreid'];

    $sqlstoreitems = "SELECT * FROM item WHERE storeid=:storeid";
    $stmt = $pdo->prepare($sqlstoreitems);
    $stmt->bindParam(':storeid', $storeid, PDO::PARAM_INT);
    $stmt->execute();
    $storeitems = $stmt->fetchAll();
    
}

#get customerid
$sqllastcustomerid = "SELECT max(id) FROM customer";
$stmt = $pdo->prepare($sqllastcustomerid); 
$stmt->execute();  
$lastcustomerid = $stmt->fetchColumn();

#staff count
if (isset($_SESSION['storestoreid'])){
    $storeid=$_SESSION['storestoreid'];

    $sqlstaffcount = "SELECT count(*) FROM staff WHERE storeid=:storeid";
    $stmt = $pdo->prepare($sqlstaffcount); 
    $stmt->bindParam(':storeid', $storeid, PDO::PARAM_INT);
    $stmt->execute();  
    $staffcount = $stmt->fetchColumn();
}
#orders count
if (isset($_SESSION['storestoreid'])){
    $storeid=$_SESSION['storestoreid'];

    $sqlsalecount = "SELECT SUM(quantity) FROM orders JOIN orderitems ON orderitems.customerid=orders.id WHERE orders.storeid=:storeid";
    $stmt = $pdo->prepare($sqlsalecount); 
    $stmt->bindParam(':storeid', $storeid, PDO::PARAM_INT);
    $stmt->execute();  
    $salecount = $stmt->fetchColumn();
}

#cartcount
if (isset($_SESSION['orderid'])){
    $sqltotalcartcount = "SELECT COUNT(*) FROM cart JOIN itemprice ON itemprice.id=cart.itempriceid WHERE customerid = :orderid AND itemprice.stock!=0";
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
$sqlonlinestorescount = "SELECT COUNT(*) FROM store WHERE status='Online'";
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

/*try {
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
}*/
if (isset($_SESSION['orderid'])){
    $orderid = $_SESSION['orderid'];
}

$sqlcategories = "SELECT DISTINCT category FROM cart LEFT JOIN itemprice ON itemprice.id=cart.itempriceid JOIN item ON item.id=itemprice.itemid JOIN store ON item.storeid=store.id WHERE store.name=:storename";
$stmtcategories = $pdo->prepare($sqlcategories);
$stmtcategories->bindParam(':storename', $storename, PDO::PARAM_STR);
$stmtcategories->execute();
$categories = $stmtcategories->fetchAll();

//fetch popular


// fetch cart details
$sqlcartstore = "SELECT DISTINCT item.storeid AS cartstoreid, store.name AS cartstorename FROM cart JOIN itemprice ON itemprice.id=cart.itempriceid JOIN item ON itemprice.itemid=item.id JOIN store ON store.id=item.storeid WHERE cart.customerid = :orderid AND itemprice.stock!=0";
$stmt = $pdo->prepare($sqlcartstore);
$stmt->bindParam(':orderid', $orderid, PDO::PARAM_STR);
$stmt->execute();
$cartstores = $stmt->fetchAll();

if (isset($cartdetail)){
    $orderid = $_SESSION['orderid'];
        $itemname=$cartdetail['itemname'];
        $cartstoreids=$cartstore['cartstoreid'];
        //fetch categories
        

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

    $sqlcombos = "SELECT item.name AS item_name, item.id AS item_id, store.name AS store_name, item.pic AS item_pic, store.pic AS store_pic FROM item JOIN popular ON popular.itemid=item.id JOIN store ON item.storeid = store.id WHERE category='Combos' AND store.name=:storename";
    $stmtcombos = $pdo->prepare($sqlcombos);
    $stmtcombos->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmtcombos->execute();
    $Combos = $stmtcombos->fetchAll();

    $sqlpopular = "SELECT item.name AS item_name, item.id AS item_id, store.name AS store_name, item.pic AS item_pic, store.pic AS store_pic FROM item JOIN popular ON popular.itemid=item.id JOIN store ON item.storeid = store.id WHERE category='Popular' AND store.name=:storename";
    $stmtpopular = $pdo->prepare($sqlpopular);
    $stmtpopular->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmtpopular->execute();
    $Popular = $stmtpopular->fetchAll();
    
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

//Store overview
$sqltopproduct = "SELECT item.name AS itemname, item.category AS itemcategory, store.name AS storename, SUM(orderitems.quantity) AS totalquantity, SUM(orderitems.quantity * itemprice.price) AS total_sales FROM item LEFT JOIN itemprice ON item.id=itemprice.itemid LEFT JOIN store ON store.id=item.storeid LEFT JOIN orderitems ON orderitems.itempriceid=itemprice.id WHERE orderitems.quantity > 0 GROUP BY itemname, itemcategory, storename ORDER BY totalquantity DESC";
$stmt = $pdo->prepare($sqltopproduct);
$stmt->execute();
$topproduct = $stmt->fetchAll();


//Store top sales
if (isset($_SESSION['storestoreid'])){
    $storeid=$_SESSION['storestoreid'];

    $sqlstoretopproduct = "SELECT item.name AS itemname, item.category AS itemcategory, store.name AS storename, SUM(orderitems.quantity) AS totalquantity, SUM(orderitems.quantity * itemprice.price) AS total_sales FROM item LEFT JOIN itemprice ON item.id=itemprice.itemid LEFT JOIN store ON store.id=item.storeid LEFT JOIN orderitems ON orderitems.itempriceid=itemprice.id WHERE orderitems.quantity > 0 AND store.id=:storeid GROUP BY itemname, itemcategory, storename ORDER BY totalquantity DESC";
    $stmt = $pdo->prepare($sqlstoretopproduct);
    $stmt->bindParam(':storeid', $storeid , PDO::PARAM_STR);
    $stmt->execute();
    $storetopproduct = $stmt->fetchAll();
}

//store sales
$sqlsuperadminsales="SELECT store.name AS storename, IFNULL(SUM(orderitems.quantity * itemprice.price), 0) AS total_sales, IFNULL(SUM(orderitems.quantity), 0) AS total_quantity FROM store LEFT JOIN item ON store.id = item.storeid LEFT JOIN itemprice ON item.id = itemprice.itemid LEFT JOIN orderitems ON itemprice.id = orderitems.itempriceid WHERE orderitems.status!='to_pay' GROUP BY storename";
$stmt = $pdo->prepare($sqlsuperadminsales);
$stmt->execute();
$superadminsales = $stmt->fetchAll();

//storesalesyearly
$sqlsuperadminsalesyearly="SELECT store.name AS storename, IFNULL(SUM(orderitems.quantity * itemprice.price), 0) AS total_sales, IFNULL(SUM(orderitems.quantity), 0) AS total_quantity FROM store LEFT JOIN item ON store.id = item.storeid LEFT JOIN itemprice ON item.id = itemprice.itemid LEFT JOIN orderitems ON itemprice.id = orderitems.itempriceid WHERE orderitems.status!='to_pay' AND YEAR(orderitems.datetime) = YEAR(CURDATE()) GROUP BY storename";
$stmt = $pdo->prepare($sqlsuperadminsalesyearly);
$stmt->execute();
$superadminsalesyearly = $stmt->fetchAll();

//storesalesmonthlu
$sqlsuperadminsalesmonthly="SELECT store.name AS storename, IFNULL(SUM(orderitems.quantity * itemprice.price), 0) AS total_sales, IFNULL(SUM(orderitems.quantity), 0) AS total_quantity FROM store LEFT JOIN item ON store.id = item.storeid LEFT JOIN itemprice ON item.id = itemprice.itemid LEFT JOIN orderitems ON itemprice.id = orderitems.itempriceid WHERE orderitems.status!='to_pay' AND YEAR(orderitems.datetime) = YEAR(CURDATE()) AND MONTH(orderitems.datetime) = MONTH(CURDATE()) GROUP BY storename";
$stmt = $pdo->prepare($sqlsuperadminsalesmonthly);
$stmt->execute();
$superadminsalesmonthly = $stmt->fetchAll();

//storsalesdaily
$sqlsuperadminsalesdaily="SELECT store.name AS storename, IFNULL(SUM(orderitems.quantity * itemprice.price), 0) AS total_sales, IFNULL(SUM(orderitems.quantity), 0) AS total_quantity FROM store LEFT JOIN item ON store.id = item.storeid LEFT JOIN itemprice ON item.id = itemprice.itemid LEFT JOIN orderitems ON itemprice.id = orderitems.itempriceid AND DATE(orderitems.datetime) = CURDATE() WHERE orderitems.status!='to_pay' GROUP BY storename";

$stmt = $pdo->prepare($sqlsuperadminsalesdaily);
$stmt->execute();
$superadminsalesdaily = $stmt->fetchAll();


if(isset($_SESSION['storestoreid'])){
    $storeid=$_SESSION['storestoreid'];
    
    $sqlstoresales="SELECT store.name AS storename, IFNULL(SUM(orderitems.quantity * itemprice.price), 0) AS total_sales, IFNULL(SUM(orderitems.quantity), 0) AS total_quantity FROM store LEFT JOIN item ON store.id = item.storeid LEFT JOIN itemprice ON item.id = itemprice.itemid LEFT JOIN orderitems ON itemprice.id = orderitems.itempriceid WHERE orderitems.status!='to_pay' AND store.id=:storeid";
    $stmt = $pdo->prepare($sqlstoresales);
    $stmt->bindParam(':storeid', $storeid , PDO::PARAM_STR);
    $stmt->execute();
    $storesales = $stmt->fetchAll();

    //storesalesyearly
    $sqlstoresalesyearly="SELECT store.name AS storename, YEAR(orderitems.datetime) AS day, IFNULL(SUM(orderitems.quantity * itemprice.price), 0) AS total_sales, IFNULL(SUM(orderitems.quantity), 0) AS total_quantity FROM store LEFT JOIN item ON store.id = item.storeid LEFT JOIN itemprice ON item.id = itemprice.itemid LEFT JOIN orderitems ON itemprice.id = orderitems.itempriceid WHERE orderitems.status != 'to_pay' AND store.id = :storeid GROUP BY YEAR(orderitems.datetime)";
    $stmt = $pdo->prepare($sqlstoresalesyearly);
    $stmt->bindParam(':storeid', $storeid , PDO::PARAM_STR);
    $stmt->execute();
    $storesalesyearly = $stmt->fetchAll();

    //storesalesmonthlu
    $sqlstoresalesmonthly="SELECT store.name AS storename, MONTHNAME(orderitems.datetime) AS day, IFNULL(SUM(orderitems.quantity * itemprice.price), 0) AS total_sales, IFNULL(SUM(orderitems.quantity), 0) AS total_quantity FROM store LEFT JOIN item ON store.id = item.storeid LEFT JOIN itemprice ON item.id = itemprice.itemid LEFT JOIN orderitems ON itemprice.id = orderitems.itempriceid WHERE orderitems.status != 'to_pay' AND YEAR(orderitems.datetime) = YEAR(CURDATE()) AND store.id = :storeid GROUP BY MONTH(orderitems.datetime)";
    $stmt = $pdo->prepare($sqlstoresalesmonthly);
    $stmt->bindParam(':storeid', $storeid , PDO::PARAM_STR);
    $stmt->execute();
    $storesalesmonthly = $stmt->fetchAll();

    //storsalesdaily
    $sqlstoresalesdaily="SELECT store.name AS storename, DAY(orderitems.datetime) AS day, IFNULL(SUM(orderitems.quantity * itemprice.price), 0) AS total_sales, IFNULL(SUM(orderitems.quantity), 0) AS total_quantity FROM store LEFT JOIN item ON store.id = item.storeid LEFT JOIN itemprice ON item.id = itemprice.itemid LEFT JOIN orderitems ON itemprice.id = orderitems.itempriceid WHERE orderitems.status != 'to_pay' AND YEAR(orderitems.datetime) = YEAR(CURDATE()) AND MONTH(orderitems.datetime) = MONTH(CURDATE()) AND store.id = :storeid GROUP BY DAY(orderitems.datetime)";
    $stmt = $pdo->prepare($sqlstoresalesdaily);
    $stmt->bindParam(':storeid', $storeid , PDO::PARAM_STR);
    $stmt->execute();
    $storesalesdaily = $stmt->fetchAll();

}

/*fetch store details*/
if (isset($_SESSION['storestoreid'])){
    $storeid=$_SESSION['storestoreid'];

    $sqlstoredeets = "SELECT * FROM store WHERE id=:storeid";
    $stmt = $pdo->prepare($sqlstoredeets); 
    $stmt->bindParam(':storeid', $storeid, PDO::PARAM_INT);
    $stmt->execute();  
    $storedeets = $stmt->fetchAll();
}

//edit store
if (isset($_POST['editstoreid'])){
    $itemid=$_POST['editstoreid'];

    $sqledititem = "SELECT DISTINCT item.*, item.id 
    FROM item 
    JOIN itemprice ON itemprice.itemid = item.id 
    WHERE item.id = :itemid
    ";
    $stmt = $pdo->prepare($sqledititem); 
    $stmt->bindParam(':itemid', $itemid, PDO::PARAM_INT);
    $stmt->execute();  
    $edititem = $stmt->fetchAll();

    $sqledititemvariant = "SELECT DISTINCT itemprice.variant FROM item JOIN itemprice ON itemprice.itemid=item.id WHERE item.id=:itemid";
    $stmt = $pdo->prepare($sqledititemvariant); 
    $stmt->bindParam(':itemid', $itemid, PDO::PARAM_INT);
    $stmt->execute();  
    $edititemvariant = $stmt->fetchAll();

    $sqledititemsize = "SELECT DISTINCT itemprice.size FROM item JOIN itemprice ON itemprice.itemid=item.id WHERE item.id=:itemid";
    $stmt = $pdo->prepare($sqledititemsize); 
    $stmt->bindParam(':itemid', $itemid, PDO::PARAM_INT);
    $stmt->execute();  
    $edititemsize = $stmt->fetchAll();


    $sqledititeminventory = "SELECT DISTINCT itemprice.*, itemprice.id AS itempriceid FROM item JOIN itemprice ON itemprice.itemid=item.id WHERE item.id=:itemid";
    $stmt = $pdo->prepare($sqledititeminventory); 
    $stmt->bindParam(':itemid', $itemid, PDO::PARAM_INT);
    $stmt->execute();  
    $edititeminventory = $stmt->fetchAll();
   
}

?>







