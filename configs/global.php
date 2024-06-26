<?php
session_start();

define('HOST_NAME', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', 'root');
define('DATABASE', 'myPHP');

$mysqli = new mysqli(HOST_NAME, USER_NAME, PASSWORD,DATABASE);

// Check connection
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

$mysqli->query("
    CREATE TABLE IF NOT EXISTS users(
        id int not null auto_increment primary key,
        name varchar(100),
        address varchar(100)
    );
");

$mysqli->query("
    CREATE TABLE IF NOT EXISTS customers(
        id int not null auto_increment primary key,
        name varchar(100),
        phone varchar(100),
        note varchar(255)
    );
");


// $sql = "SELECT * FROM customers ";
// $result = $mysqli->query($sql);
// while($cus = $result->fetch_object()){
//    echo $cus->name . "<br>";
// }




















if(!isset($_SESSION['is_login'])){
    $_SESSION['is_login'] = false;
}
$title = 'Bootstrap demo';

include('domain.php');
include('routes.php');

?>