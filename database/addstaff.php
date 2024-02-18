<?php
require_once("config.php");
if(!isset($_SESSION)){
    session_start();
}
$fname = trim($_POST['fname']);
$mname = trim($_POST['mname']);
$lname = trim($_POST['lname']);
$contactno = trim($_POST['contactno']);
$role = trim($_POST['role']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$storeid = $_SESSION['storestoreid'];

$hashedpassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO staff (storeid, fname, mname, lname, role, contactno, email, password) VALUES (:storeid, :fname, :mname, :lname, :role, :contactno, :email, :password)");
    $stmt->bindParam(':storeid', $storeid);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':mname', $mname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':contactno', $contactno);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedpassword);
    $stmt->execute();

    $_SESSION['msg']="addstaff";
    header('location: ../store/staffs.php');
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
