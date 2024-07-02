<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


if(isset($_POST['name']) && isset($_FILES['myPhoto'])){
    $name = $_POST['name'];
    $photo = $_FILES['myPhoto'];
    $product_category_id = $_POST['id'];

    if(!$name){
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];
    } else {

        $path = '';
        $product_category = $mysql->query("SELECT photo FROM product_categories WHERE id = '$product_category_id' ")->fetch_object();
        if($photo['size'] > 0){
            $path = "/web_form/projects/admin/assets/images/" . time() . $photo['name'];
            move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);

            $photo = $product_category->photo;

   
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . $photo)){
                unlink($_SERVER['DOCUMENT_ROOT'] . $photo);
            }
        } else {
            $path = $product_category->photo;
        }

       
        $mysql->query("UPDATE product_categories SET name = '$name' , photo = '$path' WHERE id = '$product_category_id' ");

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

header("Location: " . $burl . "/admin/product_categories/edit.php?product_category_id=" . $product_category_id);
?>