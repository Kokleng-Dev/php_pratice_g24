<?php

// foreach ($_FILES['myPhoto'] as $key => $value) {
//   echo $key . " : " . $value . "<br>";
// }

/*
move_uploaded_file(file, location);
*/

// type 1
// $file = $_FILES['myPhoto']['tmp_name'];
// $location = $_SERVER['DOCUMENT_ROOT'] . "/web_form/backends/assets/images/" . $_FILES['myPhoto']['name'];

// move_uploaded_file($file, $location);

// type 2
// $file = $_FILES['myPhoto']['tmp_name'];
// $prefix_folder_project = "/web_form/backends";
// function asset($path = '/assets/images/', $nameFile = []){
//     global $prefix_folder_project;

//     return $_SERVER["DOCUMENT_ROOT"] . $prefix_folder_project . $path . $nameFile['name'];
// }

// move_uploaded_file($file, asset('/assset/images/', $_FILES['myPhoto'] ));


// type 3
function uploadFile($file, $path){
    $newFile = $file['tmp_name'];
    $location = $_SERVER["DOCUMENT_ROOT"] . '/web_form/backends';
    $fullLocation = $location . $path;
    $fullLocationFile = $fullLocation . $file['name'];

    move_uploaded_file($newFile, $fullLocationFile);
}


uploadFile($_FILES['myPhoto'], '/assets/images/');

?>