<?php

$db_opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$db = new PDO('mysql:host=localhost;dbname=trended;charset=utf8', "root", "Cocokai1", $db_opt);

?>
