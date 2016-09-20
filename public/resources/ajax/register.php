<?php

include "../../../inc/db.php";

$username = isset($_POST["username"]) ? strtolower(trim($_POST["username"])) : null;
$password = isset($_POST["password"]) ? trim($_POST["password"]) : null;
$email = isset($_POST["email"]) ? strtolower(trim($_POST["email"])) : null;
$fullname = isset($_POST["fullname"]) ? strtolower(trim($_POST["fullname"])) : null;

if ($username && $password && $email && $fullname) {
  if ($db->query("SELECT COUNT(*) FROM accounts WHERE username='$username'")->fetchColumn() == 0) {
    $token = sha1(time().rand());
    $db->query("INSERT INTO accounts VALUES (null, '$username', '$password', '$email', '$fullname', '$token')");
    setCookie("token", $token, time()+3600*24*365, "/");
    echo json_encode(array("status"=>"ok"));
  } else echo json_encode(array("status"=>"failed", "message"=>"Sorry, that username is taken."));
} else echo json_encode(array("status"=>"failed", "message"=>"Please fill in all fields."));
