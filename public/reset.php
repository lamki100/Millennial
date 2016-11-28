<?php
include "../inc/db.php";

$db->query("DROP TABLE IF EXISTS accounts");
$db->query("DROP TABLE IF EXISTS banks");
$db->query("CREATE TABLE accounts (id INT PRIMARY KEY AUTO_INCREMENT, username VARCHAR(40), password VARCHAR(40), email VARCHAR(40), fullname VARCHAR(40), bio VARCHAR(80), token VARCHAR(64))");
$db->query("CREATE TABLE banks (id INT PRIMARY KEY AUTO_INCREMENT, accountid INT, bankaccount INT, bankrouting INT)");
?>

You just created/reset all the necessary tables in the Trended database. Good for you!
