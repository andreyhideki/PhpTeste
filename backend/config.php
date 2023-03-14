<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$array = [
    'error' => '',
    'result' => []
];