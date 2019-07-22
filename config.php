<?php 
	$servername = "localhost";
	$username = "abw1794guy";
	$password = "rope.7928";
	$dbname = "php_api";  
try {
    // http://php.net/manual/en/pdo.connections.php
    $conn = new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setting Error Mode as Exception
    // More on setAttribute: http://php.net/manual/en/pdo.setattribute.php
} catch(PDOException $e) {
    echo $e->getMessage();
}
 
?>