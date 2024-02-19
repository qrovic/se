<?php
require_once('../database/config.php');

try {
    if (isset($_POST['editstaffid'])) {
        $staffid = $_POST['editstaffid'];
        
        $sqlstaff = "DELETE FROM staff WHERE id = :staffid";
        $stmtstaff = $pdo->prepare($sqlstaff);
        $stmtstaff->bindParam(':staffid', $staffid, PDO::PARAM_INT);

        if ($stmtstaff->execute()) {
            header('location: ../store/staffs.php');
            $_SESSION['msg']='deletestaff';
        } else {
            echo "Error deleting record from store table";
        }
    } else {
        echo "staffid not provided";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
