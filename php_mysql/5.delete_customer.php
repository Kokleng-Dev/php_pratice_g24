<?php
include('./1.mysql.php');

$customer_id = $_GET['customer_id'];

$mysql->query("DELETE FROM customers WHERE id = '$customer_id'");

$_SESSION['sms'] = "Delete Successfully";

$route = $_SERVER['HTTP_ORIGIN'] . '/web_form/php_mysql/2.customers.php';
header("Location: $route");