<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = 'SELECT id, name, description FROM poke.pokemon';
	//$query = $conn->prepare('SELECT id, name, description	FROM poke.pokemon');
	// $query = $conn->prepare($sql,array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));

	foreach ($conn->query($sql) as $row) {
		echo $row['id'] . "\t";
		echo $row['name'] . "\t";
		echo $row['description'] . "\t";
		echo "<br>";
	}

	// echo "<pre>";
	// echo var_dump($query);
	// echo "</pre>";

	// echo "Connected successfully: ";
  } catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}