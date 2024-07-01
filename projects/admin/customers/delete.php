<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


if(isset($_GET['customer_id'])){
    $customer_id = $_GET['customer_id'];

    $customer = $mysql->query("SELECT * FROM customers WHERE id = '$customer_id'");
    $customer = $customer->fetch_object();

    if(file_exists($_SERVER['DOCUMENT_ROOT'] . $customer->photo)){
        unlink($_SERVER['DOCUMENT_ROOT'] . $customer->photo);
    }

    $mysql->query("DELETE FROM customers WHERE id = '$customer_id'");

    $_SESSION['message'] = [
        'status' => 'success',
        'sms' => 'Delete Successfully'
    ];
} else {
    $_SESSION['message'] = [
        'status' => 'error',
        'sms' => 'Validation Error'
    ];
}

header("Location: " . $burl . "/admin/customers/index.php");
?>