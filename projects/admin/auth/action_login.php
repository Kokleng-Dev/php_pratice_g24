<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");

if($_POST['username'] == 'admin' && $_POST['password'] == 123){
    $_SESSION['login'] = true;
    header("Location: " . $burl . "/admin/index.php");
}

?>