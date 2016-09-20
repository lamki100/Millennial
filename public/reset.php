<?php
include "../inc/db.php";

$db->query("DROP TABLE IF EXISTS accounts");
$db->query("CREATE TABLE accounts (id INT PRIMARY KEY AUTO_INCREMENT, username VARCHAR(30), password VARCHAR(30), email VARCHAR(50), fullname VARCHAR(30), token VARCHAR(64))");
// $db->query("INSERT INTO accounts VALUES (null, 'helms107', 'matthew', 'penis@penis.com', 'penis mcgee', 'abc123')");
// $db->query("INSERT INTO accounts VALUES (null, 'fonze100', 'alfonso', 'penis@penis.com', 'penis mcgee fonz', 'abc456')");
?>

Just reset all the tables and shit
