<?php
session_start();
if(!isset($_SESSION['is_login'])){
    $_SESSION['is_login'] = false;
}
$title = 'Bootstrap demo';

include('domain.php');
include('routes.php');

?>