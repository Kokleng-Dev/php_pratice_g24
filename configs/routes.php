<?php

$routes = [
    'home' => '/',
    'user' => '/users/index.php',
    'customer' => '/customers/index.php',
    'login' => '/auth/login.php',
    'auth.login' => '/auth/actions/login_action.php',
    'auth.logout' => '/auth/actions/logout_action.php',
    'file' => '/files/index.php',
    'action_file' => '/files/action.php'
];






function route($uri){
    global $burl;
    global $routes;
    return $burl . $routes[$uri];
}

function isRoute($uri){
    global $burl;
    global $routes;
    global $prefix_folder_project;
    if($_SERVER['REQUEST_URI'] == $prefix_folder_project . $routes[$uri]){
        return true;
    } else {
        return false;
    }
}

function asset($path = '/assets/images/'){
    global $prefix_folder_project;

    return $_SERVER["DOCUMENT_ROOT"] . $prefix_folder_project . $path;
}

?>
