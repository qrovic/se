<?php
/*try {
    // Fetch cart details 
    if (isset($_SESSION['orderid'])) {
        $orderid = $_SESSION['orderid'];
        $itemname=$cartdetail['itemname'];

        // Fetch categories
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
        $stmtcategories = $pdo->prepare($sqlitemvariants);
        $stmtcategories->bindParam(':orderid', $orderid, PDO::PARAM_STR);
        $stmtcategories->bindParam(':itemname', $itemname, PDO::PARAM_STR);
        $stmtcategories->execute();
        $itemvariants = $stmtcategories->fetchAll();
        
        // Fetch cart details
        $sqlcartdetails = "SELECT cart.customerid AS customerid, itemprice.size AS itemsize, itemprice.variant AS itemvariant, itemprice.price AS itemprice, item.category AS itemcategory, item.name AS itemname, quantity AS quantity FROM cart JOIN itemprice ON itemprice.id=cart.itempriceid JOIN item ON itemprice.itemid=item.id WHERE cart.customerid = :orderid";
        $stmt = $pdo->prepare($sqlcartdetails);
        $stmt->bindParam(':orderid', $orderid, PDO::PARAM_STR);
        $stmt->execute();
        $cartdetails = $stmt->fetchAll();
    }
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
}*/
?>