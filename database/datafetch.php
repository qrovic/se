<?php
require_once("config.php");

# Fetch all stores
$sqlstores = "SELECT * FROM store";
$stmt = $pdo->prepare($sqlstores);
$stmt->execute();  // Add this line to execute the prepared statement
$stores = $stmt->fetchAll();


# Fetch total count of stores
$sqltotalstorescount = "SELECT COUNT(*) FROM store";
$resulttotalstorescount = $pdo->query($sqltotalstorescount);
$totalstorescount = $resulttotalstorescount->fetchColumn();

# Fetch count of online stores
$sqlonlinestorescount = "SELECT COUNT(*) FROM store WHERE status='online'";
$resultonlinestorescount = $pdo->query($sqlonlinestorescount);
$onlinestorescount = $resultonlinestorescount->fetchColumn();

# Store filter based on search term
if (isset($_GET['search'])) {
    $searchterm = $_GET['search'];

    $sqlstorefilter = "SELECT * FROM store WHERE name LIKE :searchterm";
    $stmt = $pdo->prepare($sqlstorefilter);
    $stmt->bindParam(':searchterm', $searchterm, PDO::PARAM_STR);
    $stmt->execute();
    $filteredstores = $stmt->fetchAll();

    $sqlstorefiltercount = "SELECT COUNT(*) FROM store WHERE name LIKE :searchterm";
    $stmt = $pdo->prepare($sqlstorefiltercount);
    $stmt->bindParam(':searchterm', $searchterm, PDO::PARAM_STR);
    $stmt->execute();
    $filteredstorescount = $stmt->fetchColumn();
    
}

#fetch drinks items 
if (isset($_GET['storename'])) {

    $sqldrinks = "SELECT * FROM item WHERE category='drinks';";
    $stmt = $pdo->prepare($sqldrinks);
    $stmt->execute();
    $drinks = $stmt->fetchAll();
    
}


if (isset($_GET['storename']) && isset($_GET['itemsearch'])) {
    $storename = $_GET['storename'];
    $itemsearch = $_GET['itemsearch'];

    $sqlstorefilter = "SELECT * FROM store WHERE category='drinks' AND name LIKE :searchterm AND store_name = :storename";
    $stmt = $pdo->prepare($sqlstorefilter);
    $stmt->bindParam(':searchterm', '%' . $itemsearch . '%', PDO::PARAM_STR);
    $stmt->bindParam(':storename', $storename, PDO::PARAM_STR);
    $stmt->execute();
    $filteredstores = $stmt->fetchAll();
}
?>


