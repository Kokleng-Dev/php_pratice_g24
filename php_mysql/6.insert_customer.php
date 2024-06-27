<?php

include('./1.mysql.php');

$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];


for ($i=0; $i < 100; $i++) { 
    $newName = $i . '/ ' . $name;
    $mysql->query("INSERT INTO customers (name,phone,address) VALUES('$newName','$phone','$address')");
}

$route = $_SERVER['HTTP_ORIGIN'] . '/web_form/php_mysql/2.customers.php';
$_SESSION['sms'] = "Insert Succesffully";

header("Location: $route");