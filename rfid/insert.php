<?php
$servername = "localhost";
$username = "ruikiosktest2";
$password = "!MAyjune123";
$database = "id21837701_ruikiosktest2";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$course = $_POST['course'];
$year = $_POST['year'];
$rfid = $_POST['rfid'];

$sql = "INSERT INTO users (name, course, year, rfid) VALUES ('$name', '$course', '$year', '$rfid')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
