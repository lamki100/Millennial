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
  <style type='text/css'>
  @font-face {
      font-family: "Aliens";
      src: url("/resources/fonts/aliens.ttf") format('truetype');
      font-weight: 400;
  }

  @font-face {
    font-family: "Gotham";
    src: url("/resources/fonts/gotham-book.otf") format('opentype');
    font-weight: 400;
  }

  @font-face {
      font-family: "Gotham";
      src: url("/resources/fonts/gotham-bold.otf") format('opentype');
      font-weight: 600;
  }

  @font-face {
      font-family: "Gotham";
      src: url("/resources/fonts/gotham-light.otf") format('opentype');
      font-weight: 300;
  }

  @font-face {
    font-family: "Open";
    src: url("/resources/fonts/open.woff") format('woff');
    font-weight: 400;
  }

  @font-face {
      font-family: "Open";
      src: url("/resources/fonts/open-semi-bold.woff") format('woff');
      font-weight: 600;
  }

  @font-face {
      font-family: "Open";
      src: url("/resources/fonts/open-light.woff") format('woff');
      font-weight: 300;
  }

  @font-face {
      font-family: "Open";
      src: url("/resources/fonts/open-bold.woff") format('woff');
      font-weight: 700;
  }

  * { padding: 0; margin: 0; outline:0; border:0; border-radius:0; background:none; text-decoration:none; font:inherit; letter-spacing: inherit; -webkit-appearance: none; -moz-appearance: none; box-sizing: border-box; }

  #header, #master, #center { max-width: 980px; }
  #master { margin: 0 auto; }

  body {
    font-family: "Open", "Helvetica Neue", sans-serif;
    color: #222;
    -webkit-font-smoothing: antialiased;
    font-size: 13px;
    background-color: #fafafa;
    /*background: url('resources/images/bg.png') center center no-repeat;*/
    background-size: cover;
  }

  #header {
    margin: 0 auto;
    /*padding-top: 25px;*/
    padding: 14px 0 8px;
    text-align: right;
    /*height: 92px;*/
  }

  #header a {
    text-decoration: none;
    display: inline-block;
    vertical-align: top;
    color: #222;
  }

  #header-logo {
    float: left;
    font-family: "Aliens";
    line-height: 0;
    font-size: 27px;
    /*color: #000;*/
    letter-spacing: 14px;
    margin-top: 11px;
  }

  #header-globe {
    vertical-align: middle;
    height: 45px;
    /*border-right: 1px solid #eee;*/
    /*padding-right: 12px;*/
    margin-right: 22px;
    margin-top: -7px;
  }

  #header-search {
    margin: 0;
    /*margin-top: 0px;*/
    width: 0;
    height: 0;
    border: 0;
    background: url("/resources/images/search-black.png") left center no-repeat;
    background-size: 45px;
    padding: 28px;
    cursor: pointer;
    transition: width .3s, padding-left .3s;
  }

  #header-account {
    /*margin-top: -1px;*/
    /*margin-left: 4px;*/
    padding: 30px;
    background: url("/resources/images/account-black.png") center center no-repeat;
    background-size: contain;
  }

  #header-create {
    margin-top: -9px;
    margin-left: 19px;
    font-size: 67px;
    line-height: 1;
    font-weight: 300;
  }

  #header-settings {
    margin-top: 2px;
    margin-left: 19px;
    padding: 22px;
    background: url("/resources/images/settings-black.png") center center no-repeat;
    background-size: contain;
  }

  #header-search:focus {
    width: 240px;
    padding-left: 55px;
    cursor: auto;
  }

  #header-results {
    display: inline-block;
    position: absolute;
    margin-top: 69px;
    width: 255px;
    text-align: left;
    transition: height .3s, padding-top .3s;
    background-color: #f4f4f4;
    padding: 0 18px;
    overflow: hidden;
    text-transform: uppercase;
    height: 0;
  }
  </style>
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
<body>
  <div class='box'>
    <div id="header">
      <a href="/" id="header-logo"><img src='/resources/images/globe-black.png' id='header-globe'>TRENDED</a>
      <div id="header-results"></div>
      <input type='text' spellcheck='false' autocomplete='off' onblur="this.value=''; search()" id="header-search" placeholder="Search" oninput="search()">
      <?php if ($my_account) echo "<a href='/create/' id='header-created'></a><a href='/user/".$my_account["username"]."/' id='header-account'></a>"; else echo "<a href='/login/' id='header-account'></a>" ?>
    </div>
  </div>
  <div id="master">
