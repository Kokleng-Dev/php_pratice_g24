<?php

session_start();

$base_url = "http://localhost";
$project_path = "/web_form/projects";
$burl = $base_url . $project_path;
$_SESSION['login'] = (isset($_SESSION['login']) && $_SESSION['login'] == true) == true ? true  : false;

$mysql = new mysqli('localhost','root','root','project_php_pos');


?>