<?php
require_once("config.php");

$storeid = $_POST['storeid'];
$role = $_POST['role'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$contactno = $_POST['contactno'];
$email = $_POST['email'];
$password = $_POST['password'];


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO staff (storeid, role, fname, mname, lname, contactno, email, password) VALUES (:storeid, :role, :fname, :mname, :lname, :contactno, :email, :password)");
$stmt->bindParam(':storeid', $storeid);
$stmt->bindParam(':role', $role);
$stmt->bindParam(':fname', $fname);
$stmt->bindParam(':mname', $mname);
$stmt->bindParam(':lname', $lname);
$stmt->bindParam(':contactno', $contactno);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hashedPassword);

if ($stmt->execute()) {
    echo "inserted successfully.";
} else {
    echo "Error inserting record: " . $stmt->errorInfo()[2];
}
?>
