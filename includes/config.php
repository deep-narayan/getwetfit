<?php

$host = "localhost";
$username = "root";
$password = "12345";

try{
    $conn = new PDO("mysql:host = $host; dbname=getwetfit", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    // echo "Connectioon fail";
}

?>