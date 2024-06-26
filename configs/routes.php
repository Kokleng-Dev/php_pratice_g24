<?php

$routes = [
    'home' => '/',
    'user' => '/users/index.php',
    'customer' => '/customers/index.php',
    'login' => '/auth/login.php',
    'auth.login' => '/auth/actions/login_action.php',
    'auth.logout' => '/auth/actions/logout_action.php',
    'file' => '/files/index.php',
    'action_file' => '/files/action.php',
    'photo' => '/photos/index.php',
    'action_photo' => '/photos/action.php',
    'picture' => '/pictures/index.php',
    'action_picture' => '/pictures/action.php',
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


function uploadFile($file, $path = "/assets/images"){
    $newFile = $file['tmp_name'];
    $location = $_SERVER["DOCUMENT_ROOT"] . '/web_form/backends';
    $fullLocation = $location . $path;
    $fullLocationFile = $fullLocation . '/' . $file['name'];




    if(!is_dir($fullLocation)){
        mkdir($fullLocation);
    }

    move_uploaded_file($newFile, $fullLocationFile);
}

?>
