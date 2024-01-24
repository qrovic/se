<?php
require_once("config.php");

#stores
$sqlstores = "SELECT * FROM store";
$resultstores = $pdo->query($sqlstores);
$stores = $resultstores->fetchAll();
?>