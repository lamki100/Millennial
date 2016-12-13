<?php

include "../../../inc/db.php";

// TODO FILTER DATA FOR SQL INJECTION AND THE LIKE
$func = isset($_POST["func"]) ? $_POST["func"] : null;
$token = isset($_COOKIE["token"]) ? $_COOKIE['token'] : null;
$my_account = null;
if ($token) {
  $my_account = $db->query("SELECT * FROM accounts WHERE token='$token'")->fetch();
}

if ($func == "register") {
  $fullname = isset($_POST["fullname"]) ? trim($_POST["fullname"]) : null;
  $email = isset($_POST["email"]) ? strtolower(trim($_POST["email"])) : null;
  $username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
  $password = isset($_POST["password"]) ? trim($_POST["password"]) : null;

  if ($username && $password && $email && $fullname) {
    if ($db->query("SELECT COUNT(*) FROM accounts WHERE username='$username' or email='$email'")->fetchColumn() == 0) {
      $token = sha1(time().rand());
      $db->query("INSERT INTO accounts VALUES (null, '$username', '$password', '$email', '$fullname', '', 0.0, '$token')");
      setCookie("token", $token, time()+3600*24*365, "/");
      echo json_encode(array("status"=>"ok"));
    } else echo json_encode(array("status"=>"failed", "message"=>"Sorry, that username or email is taken"));
  } else echo json_encode(array("status"=>"failed", "message"=>"Please fill in all fields"));
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
      } else echo json_encode(array("status"=>"failed", "message"=>"Your password is incorrect"));
    } else echo json_encode(array("status"=>"failed", "message"=>"That username/email doesn't belong to an account"));
  } else echo json_encode(array("status"=>"failed", "message"=>"Please fill in all fields"));
}

else if ($token && $func == "updateAccount") {
  $fullname = isset($_POST["fullname"]) ? trim($_POST["fullname"]) : null;
  $email = isset($_POST["email"]) ? strtolower(trim($_POST["email"])) : null;
  $username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
  $bio = isset($_POST["bio"]) ? trim($_POST["bio"]) : null;

  if ($username && $email && $fullname) {
    if ($db->query("SELECT COUNT(*) FROM accounts WHERE (username='$username' or email='$email') and token!='$token'")->fetchColumn() == 0) {
      $db->query("UPDATE accounts SET username='$username', fullname='$fullname', email='$email', bio='$bio' WHERE token='$token'");
      echo json_encode(array("status"=>"ok", "message"=>"Changes Applied", "username"=>$username));
    } else echo json_encode(array("status"=>"failed", "message"=>"That username or email is taken"));
  } else echo json_encode(array("status"=>"failed", "message"=>"Please fill in all fields"));
}

else if ($token && $func == "addBank") {
  $id = $db->query("SELECT id FROM accounts WHERE token='$token'")->fetch()["id"];
  $account = isset($_POST["account"]) ? trim($_POST["account"]) : null;
  $routing = isset($_POST["routing"]) ? trim($_POST["routing"]) : null;
  if ($id && $account && $routing) {
    $db->query("INSERT INTO banks VALUES (null, '$id', '$account', '$routing')");
    echo json_encode(array("status"=>"ok", "message"=>"Adding bank.."));
  } else {
    echo json_encode(array("status"=>"failed", "message"=>"Please fill in all fields"));
  }
}

else if ($token && $func == "removeBank") {
  $account = isset($_POST["account"]) ? strtolower(trim($_POST["account"])) : null;

  if ($account != 0) {
    $db->query("DELETE from banks WHERE id='$account'");
    echo json_encode(array("status"=>"ok", "message"=>"Removing bank.."));
  } else {
    echo json_encode(array("status"=>"failed", "message"=>"Please select a bank"));
  }
}

else if ($token && $func == "transfer") {
  $destination = isset($_POST["destination"]) ? strtolower(trim($_POST["destination"])) : null;
  $account = isset($_POST["account"]) ? strtolower(trim($_POST["account"])) : null;
  $amount = isset($_POST["amount"]) ? doubleval(trim($_POST["amount"])) : null;

  if ($destination != 0 && $account != 0 && $amount > 0) {
    $balance = $my_account['balance'];
    if ($destination == 1) {
      $balance += $amount;
    } else if ($destination == 2) {
      $balance -= $amount;
    }
    if ($balance < 0.0) {
      echo json_encode(array("status"=>"failed", "message"=>"Cannot withdraw negative funds"));
    } else {
      $db->query("UPDATE accounts SET balance='$balance' WHERE token='$token'");
      echo json_encode(array("status"=>"ok", "message"=>"Transfering..."));
    }
  } else {
    echo json_encode(array("status"=>"failed", "message"=>"Please enter all fields"));
  }
}

else if ($token && $func == "createBet") {
  $title = isset($_POST["title"]) ? trim($_POST["title"]) : null;
  $outcomes = isset($_POST["outcomes"]) ? trim($_POST["outcomes"]) : null;
  $accountid = $my_account['id'];

  if ($title && $outcomes) {
    if ($my_account['balance'] < 5.0) {
      echo json_encode(array("status"=>"failed", "message"=>"You must have at least $5.00"));
    } else {
      $db->query("INSERT INTO bets VALUES (null, '$accountid', '$title', '$outcomes', null)");
      $path = $db->query("SELECT LAST_INSERT_ID()")->fetch()[0];
      echo json_encode(array("status"=>"ok", "path"=>"/bet/".$path."/"));
    }
  } else {
    echo json_encode(array("status"=>"failed", "message"=>"Please enter all fields"));
  }
}

else if ($token && $func == "placeBet") {
  $accountid = $my_account['id'];
  $betid = isset($_POST["betid"]) ? trim($_POST["betid"]) : null;
  $outcome = isset($_POST["outcome"]) ? trim($_POST["outcome"]) : null;
  $amount = isset($_POST["amount"]) ? doubleval(trim($_POST["amount"])) : null;

  if ($betid && $outcome && $amount) {
    if ($amount <= $my_account['balance']) {
      $balance = $my_account['balance'] - $amount;
      $db->query("UPDATE accounts SET balance='$balance' WHERE token='$token'");
      $db->query("INSERT INTO participants VALUES (null, '$accountid', '$betid', '$outcome', '$amount', null)");
      echo json_encode(array("status"=>"ok", "message"=>"Placing bet..."));
    } else {
      echo json_encode(array("status"=>"failed", "message"=>"Insufficient funds"));
    }
  } else {
    echo json_encode(array("status"=>"failed", "message"=>"Please enter all fields"));
  }
}

else echo json_encode(array("status"=>"failed", "message"=>"That function does not exist"));
