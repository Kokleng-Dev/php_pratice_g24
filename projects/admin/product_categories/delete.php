<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


if(isset($_GET['product_category_id'])){
    $product_category_id = $_GET['product_category_id'];

    $product_category = $mysql->query("SELECT * FROM product_categories WHERE id = '$product_category_id'");
    $product_category = $product_category->fetch_object();

    //check if product is belong to this cat
    $check = $mysql->query("SELECT COUNT(*) as total FROM products WHERE product_category_id = '$product_category_id'")->fetch_object()->total;

    if($check > 0){
        $_SESSION['message'] = [
            'status' => 'warning',
            'sms' => 'can not delete, there are some product is used with this category !!!'
        ];
        header("Location: " . $burl . "/admin/product_categories/index.php");
        exit();
    }
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