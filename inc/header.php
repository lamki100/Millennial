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
  <title>Profile - Trended</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <link rel='stylesheet' href='/resources/main.css'>
</head>
<script type='text/javascript'>
  function post(url, data, callback) {
    var r = new XMLHttpRequest()
    var postString = ""
    for (var key in data) postString += key + "=" + data[key] + "&"
    r.open("POST", url, true)
    r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    r.onreadystatechange = function() {
      if (r.readyState == 4) callback(r.responseText)
    }
    r.send(postString)
  }

  function search() {
    var search = document.getElementById("header-search").value.trim()
    var results = document.getElementById("header-results")

    results.innerHTML = "Search: <b>" + search + "</b>"
    if (search != "") {
      results.style.height = "300px"
      results.style.paddingTop = "20px"
      results.style.borderBottom = "2px solid rgba(255,255,255,.5)"
    } else {
      results.style.height = "0"
      results.style.paddingTop = "0"
      results.style.borderBottom = "0"
    }
  }

  function toggle(sender) {
    for (var i=0; i < sender.parentNode.children.length; i++) sender.parentNode.children[i].className='option';
    sender.className = 'option selected';
  }
</script>
<body>
  <div id="header">
    <a href="/" id="header-logo">TRENDED</a>
    <div id="header-results"></div>
    <input type='text' spellcheck='false' autocomplete='off' onblur="this.value=''; search()" id="header-search" placeholder="Search" oninput="search()">
    <a href='<?php if ($account) echo "/u/".$account["username"]."/"; else echo "/login/" ?>' id="header-account"></a>
    <?php if ($account) echo "<a href='/settings/account/' id='header-settings'></a>" ?>
  </div>
  <div id="master">
