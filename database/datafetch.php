<?php
require_once('config.php');

#stores
$sqlstores = "SELECT * from STORE";
$resultstores = $pdo->query($sqlstores);
$stores = $resultstores->fetchAll();


?>