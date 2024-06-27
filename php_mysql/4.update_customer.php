<?php
include("./1.mysql.php");



$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$customer_id = $_POST['customer_id'];

$statement = "UPDATE customers SET name = '$name', address = '$address', phone = '$phone' WHERE id = $customer_id";


try {
    $update = $mysql->query($statement);
    $route = $_SERVER['HTTP_ORIGIN'] . '/web_form/php_mysql/2.customers.php';

    $_SESSION['sms'] = 'Update Successfully';
    
    header("Location: " . $route);
} catch (\Throwable $th) {
    echo $th->getMessage();
    exit();
}
