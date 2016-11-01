<?php

include "../../../inc/db.php";

$token = isset($_COOKIE["token"]) ? $_COOKIE['token'] : null;
// echo $token;
// $my_account = null;
// if ($token) {
//   $my_account = $db->query("SELECT * FROM accounts WHERE token='$token'")->fetch();
//   if (!$my_account) setcookie("token", "", time() - 10000);
//   else $my_account = $my_account['id'];
// }
// echo $my_account;

// TODO FILTER DATA FOR SQL INJECTION AND THE LIKE
$func = isset($_POST["func"]) ? $_POST["func"] : null;

if ($func == "register") {
  $fullname = isset($_POST["fullname"]) ? trim($_POST["fullname"]) : null;
  $email = isset($_POST["email"]) ? strtolower(trim($_POST["email"])) : null;
  $username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
  $password = isset($_POST["password"]) ? trim($_POST["password"]) : null;

  if ($username && $password && $email && $fullname) {
    if ($db->query("SELECT COUNT(*) FROM accounts WHERE username='$username' or email='$email'")->fetchColumn() == 0) {
      $token = sha1(time().rand());
      $db->query("INSERT INTO accounts VALUES (null, '$username', '$password', '$email', '$fullname', '', '$token')");
      setCookie("token", $token, time()+3600*24*365, "/");
      echo json_encode(array("status"=>"ok"));
    } else echo json_encode(array("status"=>"failed", "message"=>"Sorry, that username or email is taken"));
  } else echo json_encode(array("status"=>"failed", "message"=>"Please fill in all fields."));
}

else if ($func == "login") {
  $username = isset($_POST["username"]) ? strtolower(trim($_POST["username"])) : null;
  $password = isset($_POST["password"]) ? trim($_POST["password"]) : null;

  if ($username && $password) {
    $account = $db->query("SELECT * FROM accounts WHERE username='$username' OR email='$username'")->fetch();
    if ($account) {
      if ($account['password'] == $password) {
        setCookie("token", $account['token'], time()+3600*24*365, "/");
        echo json_encode(array("status"=>"ok"));
      } else echo json_encode(array("status"=>"failed", "message"=>"Your password is incorrect."));
    } else echo json_encode(array("status"=>"failed", "message"=>"That username/email doesn't belong to an account."));
  } else echo json_encode(array("status"=>"failed", "message"=>"Please fill in all fields."));
}

else if ($token && $func == "updateAccount") {
  $fullname = isset($_POST["fullname"]) ? trim($_POST["fullname"]) : null;
  $email = isset($_POST["email"]) ? strtolower(trim($_POST["email"])) : null;
  $username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
  $bio = isset($_POST["bio"]) ? trim($_POST["bio"]) : null;

  if ($username && $email && $fullname) {
    if ($db->query("SELECT COUNT(*) FROM accounts WHERE (username='$username' or email='$email') and token!='$token'")->fetchColumn() == 0) {
      $db->query("UPDATE accounts SET username='$username', fullname='$fullname', email='$email', bio='$bio' WHERE token='$token'");
      echo json_encode(array("status"=>"ok"));
    } else echo json_encode(array("status"=>"failed", "message"=>"That username or email is taken."));
  } else echo json_encode(array("status"=>"failed", "message"=>"Something went wrong."));
} else {
  echo json_encode(array("status"=>"failed", "message"=>"Something went terribly wrong."));
}
