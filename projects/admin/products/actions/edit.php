<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");

$product_id = 0;


if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['product_category_id']) && isset($_POST['id'])) {
    $product_id = $_POST['id'];
 
    $name = $_POST['name'];
    $photo = $_FILES['myPhoto'];
    $price = $_POST['price'];
    $product_category_id = $_POST['product_category_id'];

 
    if(!$name || !$product_category_id || !$product_id){
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];
    } else {

        $product =  $mysql->query("SELECT * FROM products WHERE id = '$product_id' ")->fetch_object();
        $path = '';
        if($photo['size'] > 0){
            $path = "/web_form/projects/admin/assets/images/" . time() . $photo['name'];
            move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);

          
            $photo = $product->photo;

   
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . $photo)){
                unlink($_SERVER['DOCUMENT_ROOT'] . $photo);
            }
        } 


        if($path){
            $mysql->query("UPDATE products SET name = '$name' , photo = '$path', price = '$price', product_category_id = '$product_category_id'  WHERE id = '$product_id' ");
        } else {
            $mysql->query("UPDATE products SET name = '$name', price = '$price', product_category_id = '$product_category_id'  WHERE id = '$product_id' ");
        }

        $_SESSION['message'] = [
            'status' => 'success',
            'sms' => 'Update Successfully'
        ];
    }
} else {
    $_SESSION['message'] = [
        'status' => 'error',
        'sms' => 'Validation Error'
    ];
}

header("Location: " . $burl . "/admin/products/edit.php?product_id=" . $product_id);
?>