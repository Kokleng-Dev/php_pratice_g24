<?php
    include("../../../configs/global.php");

    if(isset($_POST['username']) && $_POST['password']){
        if($_POST['username'] == 'admin' && $_POST['password'] == 123){
            // correct username and password
            // let remember user login
            setcookie('auth', true , time() + 100);


            // after set cookie , redirect back to home page
            header("Location: " . route('home') . "?status=1&sms=Login Successfully, Welcome Back ...");
        } else {

            // incorrect password or username, redirect back to login again
            header("Location: " . route("login") . "?status=0&sms=Incorrect Password, Please Try Again !!");
        }
    } else {

        // not found password or username request via POST, redirect back to login again
        header("Location: " . route("login"));
    }
?>