<?php
    include("../../../configs/global.php");

    function handleLogin($condition){
        if($condition == false){
            $_SESSION['logic'] = [
                'status' => "error",
                'sms' => 'Incorrect Username or Passowrd !!!'
            ];
            header("Location: " . route('login'));
        } else {
            $_SESSION['logic'] = [
                'status' => "success",
                'sms' => 'Login Successfully !!!'
            ];
            $_SESSION['is_login'] = true;
            header("Location: " . route('home'));
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!$username || !$password){
            handleLogin(false);
        } else {
            if($username == 'admin' && $password == '123'){
                handleLogin(true);
            } else {
                handleLogin(false);
            }
        }
    } else {
        handleLogin(false);
    }
?>