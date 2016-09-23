<?php
include "db.php";

$token = isset($_COOKIE["token"]) ? $_COOKIE["token"] : null;
$account = null;
if ($token) {
  $account = $db->query("SELECT * FROM accounts WHERE token='$token'")->fetch();
  if (!$account) setcookie("token", "", time() - 10000);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile - Trender</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <link rel='stylesheet' href='/resources/main.css'>
</head>
<body>
  <div id="header">
    <a href="/" id="header-logo">TRENDER</a>
    <div id="header-results"></div>
    <input type='text' spellcheck='false' autocomplete='off' onblur="this.value=''; search()" id="header-search" placeholder="Search" oninput="search()">
    <a href='<?php if ($account) echo "/u/".$account["username"]."/"; else echo "/login/" ?>' id="header-account"></a>
    <?php if ($account) echo "<a href='/settings/' id='header-settings'></a>" ?>
  </div>
  <div id="master">
