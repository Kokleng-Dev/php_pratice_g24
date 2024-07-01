<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


if(isset($_POST['name']) && isset($_FILES['myPhoto'])){
    $name = $_POST['name'];
    $photo = $_FILES['myPhoto'];

    if(!$name || !$photo){
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];
    } else {

        $path = "/web_form/projects/admin/assets/images/" . time() . $photo['name'];
        move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);

        $mysql->query("INSERT INTO customers (name,photo) VALUES('$name','$path')");

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

header("Location: " . $burl . "/admin/customers/create.php");
?>