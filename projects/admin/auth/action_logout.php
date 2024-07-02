<?php

include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");


$_SESSION['message'] = [
    'status' => 'warning',
    'sms' => 'Logout Successfully'
];

$_SESSION['login'] = false;
$_SESSION['auth'] = 0;

header("Location: ". $burl . "/admin/auth/login.php");


?>