<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");

$user_id = 0;

if(isset($_POST['name']) && isset($_POST['username'])){
    $name = $_POST['name'];
    $photo = $_FILES['myPhoto'];
    $user_id = $_POST['id'];
    $username = $_POST['username'];
    $new_password = $_POST['password'];
    $old_password = $_POST['old_password'];

    if(!$name){
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];
    } else {

        $user =  $mysql->query("SELECT * FROM users WHERE id = '$user_id' ")->fetch_object();
        $path = '';
        if($photo['size'] > 0){
            $path = "/web_form/projects/admin/assets/images/" . time() . $photo['name'];
            move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);

          
            $photo = $user->photo;

   
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . $photo)){
                unlink($_SERVER['DOCUMENT_ROOT'] . $photo);
            }
        } 


        $password = $user->password;
        if($old_password){
            if($user->password != $old_password){
                $_SESSION['message'] = [
                    'status' => 'error',
                    'sms' => 'Old Password is incorrect'
                ];
                header("Location: " . $burl . "/admin/users/edit.php?user_id=" . $user_id);

                exit();
            }
            $password = $new_password;
        } 

        if($path){
            $mysql->query("UPDATE users SET name = '$name' , photo = '$path', username = '$username', password = '$password'  WHERE id = '$user_id' ");
        } else {
            $mysql->query("UPDATE users SET name = '$name', username = '$username', password = '$password'  WHERE id = '$user_id' ");
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

header("Location: " . $burl . "/admin/users/edit.php?user_id=" . $user_id);
?>