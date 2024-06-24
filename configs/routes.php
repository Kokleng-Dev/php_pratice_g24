<?php

$routes = [
    'home' => '/index.php',
    'user' => '/users/index.php',
    'customer' => '/customers/index.php'
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

?>
