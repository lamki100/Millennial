<?php
include "db.php";

$account = null;
$token = isset($_COOKIE["token"]) ? $_COOKIE["token"] : null;
if ($token) {
  $account = $db->query("SELECT * FROM accounts WHERE token='$token'")->fetch();
  if (!$account) setcookie("token", "", time() - 10000);
}

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
      <input type='text' placeholder='Search' spellcheck='false' autocomplete='off' maxlength='30' id='search' onblur="this.value=''"><?php if ($account) echo "<a href='profile.php'>".$account["username"]."</a><a href='logout.php'>Logout</a>"; else echo "<a href='register.php'>Register</a><a href='login.php'>Login</a>"; ?>
    </div>
  </div>
  <div id="master">
