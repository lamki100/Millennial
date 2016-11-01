<?php
include "../inc/db.php";

$db->query("DROP TABLE IF EXISTS accounts");
$db->query("CREATE TABLE accounts (id INT PRIMARY KEY AUTO_INCREMENT, username VARCHAR(40), password VARCHAR(40), email VARCHAR(40), fullname VARCHAR(40), bio VARCHAR(80), token VARCHAR(64))");
// $db->query("INSERT INTO accounts VALUES (null, 'helms107', 'password1', 'matthewthelms@yahoo.com', 'Matthew Helms', 'abc123')");
?>

You just created/reset all the necessary tables in the Trended database. Good for you!
