<?php

include "../../../inc/db.php";

$username = isset($_POST["username"]) ? strtolower(trim($_POST["username"])) : 0;
$password = isset($_POST["password"]) ? trim($_POST["password"]) : 0;
$email = isset($_POST["email"]) ? strtolower(trim($_POST["email"])) : 0;
$fullname = isset($_POST["fullname"]) ? strtolower(trim($_POST["fullname"])) : 0;

if ($username && $password && $email && $fullname) {
  echo $db->query("SELECT * FROM accounts WHERE username='$username'");
  if (count($db->query("SELECT * FROM accounts WHERE username='$username'"))) {
    $token = sha1(time().rand());
    $db->query("INSERT INTO accounts VALUES (null, '$username', '$password', '$email', '$fullname', '$token')");
    echo json_encode(array("status"=>"ok", "token"=>$token));
  } else echo json_encode(array("status"=>"failed", "message"=>"Sorry, that username is taken."));
} else echo json_encode(array("status"=>"failed", "message"=>"Please fill in all fields."));
