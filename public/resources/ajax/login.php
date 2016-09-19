<?php

include "../../../inc/db.php";

$username = isset($_POST["username"]) ? strtolower(trim($_POST["username"])) : 0;
$password = isset($_POST["password"]) ? trim($_POST["password"]) : 0;

if ($username && $password) {
  $result = $db->query("SELECT * FROM accounts WHERE username='$username'");
  if ($result->num_rows) {
    $account = $result->fetch_assoc();
    if ($account['password'] == $password) return array("func"=> "login", "status"=>"ok", "token"=>$account['token']);
    else echo json_encode(array("func"=>"login", "status"=>"failed", "message"=>"Sorry, your password is incorrect."));
  } else echo json_encode(array("func"=>"login", "status"=>"failed", "message"=>"That username doesn't belong to an account."));
} else echo json_encode(array("func"=>"login", "status"=>"failed", "message"=>"Please fill in all fields."));
