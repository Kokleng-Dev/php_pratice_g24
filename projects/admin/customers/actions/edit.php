<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


if(isset($_POST['name']) && isset($_FILES['myPhoto'])){
    $name = $_POST['name'];
    $photo = $_FILES['myPhoto'];
    $customer_id = $_POST['id'];

    if(!$name){
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];
    } else {

        $path = '';
        if($photo){
            $path = "/web_form/projects/admin/assets/images/" . time() . $photo['name'];
            move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);

            $photo = $mysql->query("SELECT photo FROM customers WHERE id = '$customer_id' ");
            $photo = $photo->fetch_object()->photo;

   
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . $photo)){
                unlink($_SERVER['DOCUMENT_ROOT'] . $photo);
            }
        } 

       
        $mysql->query("UPDATE customers SET name = '$name' , photo = '$path' WHERE id = '$customer_id' ");

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

header("Location: " . $burl . "/admin/customers/edit.php?customer_id=" . $customer_id);
?>