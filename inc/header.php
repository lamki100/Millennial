<?php
include "db.php";

$token = isset($_COOKIE["token"]) ? $_COOKIE["token"] : null;
$my_account = null;
if ($token) {
  $my_account = $db->query("SELECT * FROM accounts WHERE token='$token'")->fetch();
  if (!$my_account) setcookie("token", "", time() - 10000);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Trended</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <link rel='stylesheet' href='/resources/main-white.css'>
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
        results.style.paddingTop = "18px"
      } else {
        results.style.height = "0"
        results.style.paddingTop = "0"
      }
    }

    function toggle(sender) {
      for (var i=0; i < sender.parentNode.children.length; i++) sender.parentNode.children[i].className='option';
      sender.className = 'option selected';
    }
    </script>
</head>
<body>
  <div class='box' style='box-shadow: 0px 1px 2px rgba(0,0,0,.06)'>
    <div id="header">
      <a href="/" id="header-logo"><img src='/resources/images/globe-black.png' id='header-globe'>TRENDED</a>
      <div id="header-results" class='box'></div>
      <input type='text' spellcheck='false' autocomplete='off' onblur="this.value=''; search()" id="header-search" placeholder="Search" oninput="search()">
      <?php if ($my_account) echo "<a href='/create/' id='header-create'>+</a><a href='/user/".$my_account["username"]."/' id='header-account'></a>"; else echo "<a href='/login/' id='header-account'></a>" ?>
    </div>
  </div>
  <div id="master">
