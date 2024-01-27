<?php
require_once('../database/config.php');

try {
    if (isset($_POST['storeid'])) {
        $storeid = $_POST['storeid'];
        $sql = "DELETE FROM store WHERE id = :storeid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':storeid', $storeid, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('location: ../superadmin/accounts.php');
        } else {
            echo "Error deleting record";
        }
    } else {
        echo "storeid not provided";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
