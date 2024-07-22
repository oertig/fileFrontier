<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// TODO: move values to config file
// TODO: create db schema file within repo
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>