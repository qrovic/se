<?php

    
        $orderid = $_SESSION['orderid'];
        if (isset($cartdetail)){
            $itemname=$cartdetail['itemname'];
        }
        if (isset($cartstore)){
            $cartstoreids=$cartstore['cartstoreid'];
        }
        
        //fetch categories
        

        $sqlitemvariants = "SELECT DISTINCT itemprice.variant
        FROM itemprice JOIN item ON item.id=itemprice.itemid
        WHERE item.id IN (
            SELECT item.id
            FROM item
            JOIN itemprice ON item.id = itemprice.itemid
            JOIN cart ON itemprice.id = cart.itempriceid
            WHERE cart.customerid = :orderid AND item.name=:itemname AND itemprice.stock!=0);";
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
            WHERE cart.customerid = :orderid AND item.name=:itemname AND itemprice.stock!=0);";
        $stmtsize = $pdo->prepare($sqlitemsizes);
        $stmtsize->bindParam(':orderid', $orderid, PDO::PARAM_STR);
        $stmtsize->bindParam(':itemname', $itemname, PDO::PARAM_STR);
        $stmtsize->execute();
        $itemsizes = $stmtsize->fetchAll();
        
        // fetch cart details
        $sqlcartdetails = "SELECT cart.customerid AS customerid, itemprice.id AS itempriceid, itemprice.size AS itemsize, itemprice.variant AS itemvariant, itemprice.price AS itemprice, item.category AS itemcategory, item.name AS itemname, itemprice.itemid AS itemid, quantity AS quantity FROM cart JOIN itemprice ON itemprice.id=cart.itempriceid JOIN item ON itemprice.itemid=item.id WHERE cart.customerid = :orderid AND item.storeid= :cartstoreid AND itemprice.stock!=0";
        $stmt = $pdo->prepare($sqlcartdetails);
        $stmt->bindParam(':orderid', $orderid, PDO::PARAM_STR);
        $stmt->bindParam(':cartstoreid', $cartstoreids, PDO::PARAM_STR);
        $stmt->execute();
        $cartdetails = $stmt->fetchAll();
        
        


?>