<?php

include "../../../inc/db.php";

// TODO FILTER DATA FOR SQL INJECTION AND THE LIKE
$username = isset($_POST["username"]) ? strtolower(trim($_POST["username"])) : null;
$password = isset($_POST["password"]) ? trim($_POST["password"]) : null;

if ($username && $password) {
  $account = $db->query("SELECT * FROM accounts WHERE username='$username'")->fetch();
  if ($account) {
    if ($account['password'] == $password) {
      setCookie("token", $account['token'], time()+3600*24*365, "/");
      echo json_encode(array("status"=>"ok"));
    } else echo json_encode(array("status"=>"failed", "message"=>"Your password is incorrect."));
  } else echo json_encode(array("status"=>"failed", "message"=>"That username doesn't belong to an account."));
} else echo json_encode(array("status"=>"failed", "message"=>"Please fill in all fields."));
