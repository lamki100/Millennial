<?php
include "../inc/db.php";

$db->query("DROP TABLE IF EXISTS accounts");
$db->query("DROP TABLE IF EXISTS banks");
$db->query("DROP TABLE IF EXISTS bets");
$db->query("DROP TABLE IF EXISTS participants");

$db->query("CREATE TABLE accounts (id INT PRIMARY KEY AUTO_INCREMENT, username VARCHAR(40), password VARCHAR(40), email VARCHAR(40), fullname VARCHAR(40), bio VARCHAR(80), balance DOUBLE, token VARCHAR(64))");
$db->query("CREATE TABLE banks (id INT PRIMARY KEY AUTO_INCREMENT, accountid INT, bankaccount INT, bankrouting INT)");
$db->query("CREATE TABLE bets (id INT PRIMARY KEY AUTO_INCREMENT, accountid INT, title VARCHAR(80), outcomes VARCHAR(160), time TIMESTAMP DEFAULT NOW())");
$db->query("CREATE TABLE participants (id INT PRIMARY KEY AUTO_INCREMENT, accountid INT, betid INT, outcome VARCHAR(40), amount DOUBLE, time TIMESTAMP DEFAULT NOW())");
?>

You just created/reset all the necessary tables in the Trended database. Good for you!
