<?php
ini_set('display_errors', 1);
require_once('WebSockets.php');

class User extends WebSocketUser {
  public $account = array();
}

class Database {
  public $db = null;

  function __construct() {
    $this->db = new mysqli("127.0.0.1", "root", "Cocokai1", "trended");
    // $this->db->query("DROP TABLE IF EXISTS accounts");
    // $this->db->query("CREATE TABLE accounts (id INT PRIMARY KEY AUTO_INCREMENT, username VARCHAR(30), password VARCHAR(30), email VARCHAR(50), fullname VARCHAR(30), token VARCHAR(64))");
  }

  function initialize($user) {
    $token = $this->getCookie($user, "token");
    if ($token != "") {
      $result = $this->db->query("SELECT * FROM accounts WHERE token='$token'");
      if ($result->num_rows == 1) {
        $user->account = $result->fetch_assoc();
        return array("func"=>"initialize", "logged-in"=>true, "account"=>$user->account, "trending"=>$this->getTrending());
      }
    }
    return array("func"=>"initialize", "logged-in"=>false, "trending"=>$this->getTrending());
  }

  function register($fullname, $email, $username, $password) {
    if ($username != "" && $password != "" && $email != "" && $fullname != "") {
      if ($this->db->query("SELECT * FROM accounts WHERE username='$username'")->num_rows == 0) {
        $token = sha1(time().rand());
        $this->db->query("INSERT INTO accounts VALUES (null, '$username', '$password', '$email', '$fullname', '$token')");
        return array("func"=>"register", "status"=>"ok", "token"=>$token);
      } else return array("func"=>"register", "status"=>"failed", "message"=>"Sorry, that username is taken.");
    } else return array("func"=>"register", "status"=>"failed", "message"=>"Please fill in all fields.");
  }

  function login($username, $password) {
    if ($username != "" && $password != "") {
      $result = $this->db->query("SELECT * FROM accounts WHERE username='$username'");
      if ($result->num_rows != 0) {
        $account = $result->fetch_assoc();
        if ($account['password'] == $password) return array("func"=> "login", "status"=>"ok", "token"=>$account['token']);
        else return array("func"=>"login", "status"=>"failed", "message"=>"Sorry, your password is incorrect.");
      } else return array("func"=>"login", "status"=>"failed", "message"=>"That username doesn't belong to an account.");
    } else return array("func"=>"login", "status"=>"failed", "message"=>"Please fill in all fields.");
  }

  function getUser($username) {
    if ($username != "") {
      $result = $this->db->query("SELECT * FROM accounts WHERE username='$username'");
      if ($result->num_rows != 0) {
        $account = $result->fetch_assoc();
        return array("func"=>"getUser", "status"=>"ok", "fullname"=> ucwords($account["fullname"]), "username"=>$account["username"]);
      }
    }
    return array("func"=>"getUser", "status"=>"failed");
  }

  function getTrending() {
    $trendingNames = explode(",", "DONALD TRUMP,JUSTIN BIEBER,G-EAZY,KANYE WEST,KIM KARDASHIAN,RADIOHEAD,GAME OF THRONES,ARIANA GRANDE,JON HOPKINS,MUSE,BATMAN VS SUPERMAN,SUICIDE SQUAD,MAD MEN,HORRIBLE BOSSES,SACHA BARON COHEN,TAYLOR SWIFT,COLDPLAY,FRANK OCEAN,LACMA");
    $trendingAccounts = array();
    foreach ($trendingNames as $name) {
      array_push($trendingAccounts, array("username"=>str_replace(" ", "", $name), "fullname"=>$name));
    }
    return $trendingAccounts;
  }

  function getCookie($user, $name) {
    if (array_key_exists("cookie", $user->headers)) {
      $cookies = explode(";", $user->headers['cookie']);
      for ($i = 0; $i < count($cookies); $i++) {
        $cookie = explode("=", $cookies[$i]);
        if (trim($cookie[0]) == $name) return trim($cookie[1]);
      }
    }
    return "";
  }
}

class Server extends WebSocketServer {

  protected $accounts = array();
  protected $db;

  public function __construct() {
    parent::__construct();
    $this->db = new Database();
  }

  protected function tick() { }

  protected function connected($user) {
    $this->send($user, json_encode($this->db->initialize($user)));
  }

  protected function process($user, $data) {
    $data = json_decode($data, true);

    if ($data["func"] == "login") {
      $this->send($user, json_encode($this->db->login($data["username"], $data["password"])));
    }
    else if ($data["func"] == "register") {
      $this->send($user, json_encode($this->db->register($data["fullname"], $data["email"], $data["username"], $data["password"])));
    }
    else if ($data["func"] == "getUser") {
      $this->send($user, json_encode($this->db->getUser($data["username"])));
    }
  }

  protected function closed($player) { }
}

$s = new Server("8080");
$s->run();
