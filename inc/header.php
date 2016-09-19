<?php

include "db.php";

function tables() {
  global $db;
  $db->query("DROP TABLE IF EXISTS accounts");
  $db->query("CREATE TABLE accounts (id INT PRIMARY KEY AUTO_INCREMENT, username VARCHAR(30), password VARCHAR(30), email VARCHAR(50), fullname VARCHAR(30), token VARCHAR(64))");
}
// tables();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Trended</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <link rel='stylesheet' href='resources/main.css'>
</head>
<body>
  <div id="header-container">
    <div id="header">
      <a style="float:left; margin:0; letter-spacing:5px; font-weight: 600;" href="/">trende<span style='letter-spacing:0'>d</span></a>
      <input type='text' placeholder='Search' spellcheck='false' autocomplete='off' maxlength='30' id='search' onblur="this.value=''"><a href='register.php'>Register</a><a href='login.php'>Login</a>
    </div>
  </div>
  <div id="master">
