<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


if(isset($_POST['name']) && isset($_FILES['myPhoto']) && isset($_POST['price']) && isset($_POST['product_category_id'])){
    $name = $_POST['name'];
    $photo = $_FILES['myPhoto'];
    $price = $_POST['price'];
    $product_category_id = $_POST['product_category_id'];
    $created_at = date('Y-m-d H:i:s');
    $created_by = $_SESSION['auth'];

  

    if(!$name || !$photo || !$price || !$product_category_id){
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];
    } else {

        $path = "/web_form/projects/admin/assets/images/" . time() . $photo['name'];
        move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);

        $mysql->query("INSERT INTO products (name,price,product_category_id,photo,created_at,created_by) VALUES('$name','$price','$product_category_id','$path','$created_at','$created_by')");

        $_SESSION['message'] = [
            'status' => 'success',
            'sms' => 'Insert Successfully'
        ];
    }
} else {
    $_SESSION['message'] = [
        'status' => 'error',
        'sms' => 'Validation Error'
    ];
}

header("Location: " . $burl . "/admin/products/create.php");
?>