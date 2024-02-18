<?php
require_once("config.php");

if(!isset($_SESSION)){
    session_start();
}

$staffid = filter_var($_POST['staffid'], FILTER_SANITIZE_NUMBER_INT);
$fname = filter_var(trim($_POST['fname']), FILTER_SANITIZE_STRING);
$mname = filter_var(trim($_POST['mname']), FILTER_SANITIZE_STRING);
$lname = filter_var(trim($_POST['lname']), FILTER_SANITIZE_STRING);
$contactno = filter_var(trim($_POST['contactno']), FILTER_SANITIZE_NUMBER_INT);
$role = filter_var(trim($_POST['role']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

try {
    $stmt = $pdo->prepare("UPDATE staff SET fname = :fname, mname = :mname, lname = :lname, role = :role, contactno = :contactno, email = :email WHERE id = :staffid");
    $stmt->bindParam(':staffid', $staffid);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':mname', $mname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':contactno', $contactno);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $_SESSION['msg']="editstaff";
    header('location: ../store/staffs.php');
    exit(); 
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
