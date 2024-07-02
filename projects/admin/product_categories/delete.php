<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


if(isset($_GET['product_category_id'])){
    $product_category_id = $_GET['product_category_id'];

    $product_category = $mysql->query("SELECT * FROM product_categories WHERE id = '$product_category_id'");
    $product_category = $product_category->fetch_object();

    if(file_exists($_SERVER['DOCUMENT_ROOT'] . $product_category->photo)){
        unlink($_SERVER['DOCUMENT_ROOT'] . $product_category->photo);
    }

    $mysql->query("DELETE FROM product_categories WHERE id = '$product_category_id'");

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

header("Location: " . $burl . "/admin/product_categories/index.php");
?>