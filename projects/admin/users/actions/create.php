<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


if(isset($_POST['name']) && isset($_FILES['myPhoto']) && isset($_POST['username']) && isset($_POST['password'])){
    $name = $_POST['name'];
    $photo = $_FILES['myPhoto'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!$name || !$photo){
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];
    } else {

        $path = "/web_form/projects/admin/assets/images/" . time() . $photo['name'];
        move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);

        $mysql->query("INSERT INTO users (name,username,password,photo) VALUES('$name','$username','$password','$path')");

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

header("Location: " . $burl . "/admin/users/create.php");
?>