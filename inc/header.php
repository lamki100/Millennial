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
  <div id="header">
    <a href="/" id="header-logo">TRENDED</a>
    <input type='text' spellcheck='false' autocomplete='off' onblur="this.value=''; search()" id="header-search" placeholder="Search" oninput="search()">
    <div id="header-results"></div>
    <a href='<?php if ($account) echo $account["username"].".php"; else echo "login.php" ?>' id="header-account"></a>
    <?php if ($account) echo "<a href='settings.php' id='header-settings'></a>" ?>
  </div>
  <div id="master">
