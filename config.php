<?php
$server_name = "localhost";
$server_username = "root";
$server_password = "";

try {
    $conn = new PDO("mysql:host=$server_name;dbname=vehicle_log", $server_username, $server_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
