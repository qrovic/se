<?php
require_once('../database/config.php');

try {
    if (isset($_POST['deletecartitempriceid']) && isset($_POST['deletecartorderid'])) {
        $itempriceid = $_POST['deletecartitempriceid'];
        $cartorderid = $_POST['deletecartorderid'];
        
        $sqlcart= "DELETE FROM cart WHERE customerid = :cartorderid AND itempriceid = :itempriceid";
        $stmtcart = $pdo->prepare($sqlcart);
        $stmtcart->bindParam(':cartorderid', $cartorderid, PDO::PARAM_INT);
        $stmtcart->bindParam(':itempriceid', $itempriceid, PDO::PARAM_INT);

        if ($stmtcart->execute()) {
            echo "success";
            $_SESSION['msg']='deletecart';
        } else {
            echo "error";
        }
    } else {
        echo "customerid not provided";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
