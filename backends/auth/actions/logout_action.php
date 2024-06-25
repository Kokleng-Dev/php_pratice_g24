<?php
    include("../../../configs/global.php");
    $_SESSION['logic'] = [
        'status' => "success",
        'sms' => 'Logout Successfully !!!'
    ];
    $_SESSION['is_login'] = false;

    header("Location: " . route('login'));
?>