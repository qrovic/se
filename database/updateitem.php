<?php   

require_once('../database/config.php');

$itemid = $_POST['itemid'][0];
$itemprices = $_POST['itemprices'];
$itemstocks = $_POST['itemstocks'];
$itemidpriceid = $_POST['itemidpriceid'];

foreach ($itemidpriceid as $key => $priceId) {
    $price = $itemprices[$key];
    $stock = $itemstocks[$key];
    
    echo "Item ID: $itemid, Item Price ID: $priceId, Price: $price, Stock: $stock <br>";

    try {
        $stmt = $pdo->prepare("UPDATE itemprice SET price = :price, stock = :stock WHERE id = :itempriceid");
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':itempriceid', $priceId);
        $stmt->execute();
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
$_SESSION['msg']="editinventory";
header('location: ../store/menus.php');
exit(); 

    
    
    
?>