<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];

    $product = $mysql->query("SELECT * FROM products WHERE id = '$product_id'");
    $product = $product->fetch_object();

    if(file_exists($_SERVER['DOCUMENT_ROOT'] . $product->photo)){
        unlink($_SERVER['DOCUMENT_ROOT'] . $product->photo);
    }

    $mysql->query("DELETE FROM products WHERE id = '$product_id'");

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

header("Location: " . $burl . "/admin/products/index.php");
?>