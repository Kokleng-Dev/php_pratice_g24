<?php

include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");

$_SESSION['login'] = false;

header("Location: ". $burl . "/admin/auth/login.php");


?>