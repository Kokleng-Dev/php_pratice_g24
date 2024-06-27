<?php

$host = "127.0.0.1";
// $port = "3306";
$username = "root";
$password = "root";
$database_name = "php_db";


try {
    $mysql = new mysqli($host, $username, $password, $database_name);
    if ($mysql->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
} catch (\Throwable $e) {
    echo "<h2>" . $e->getMessage() . "</h2>";
    exit();
}


session_start();



 
?>