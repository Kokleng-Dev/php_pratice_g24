<?php
include('../../configs/global.php');

if(isset($_FILES['photo'])){

    $errors = [];
    $j = -1;

    for($i = 0; $i < count($_FILES['photo']['name']); $i++){
        $j++;

        $file_name = $_FILES['photo']['name'][$i];
        $file_tmp = $_FILES['photo']['tmp_name'][$i];
    
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);


 
        if($_FILES['photo']['size'][$i] >= 100000000){ // > 2MB of file size
            $errors[$j] = 'Not Support File biggter than 100MB of file ' . $file_name;
            continue;
        }

        if($file_ext != 'png' || $file_ext != 'pdf'){
            $errors[$j] = 'Support only PNG : ' . $file_name;
            continue;
        } 

        
        // var_dump(move_uploaded_file($file_tmp, asset('/assets/images/') .$file_name));
        if(!move_uploaded_file($file_tmp, asset('/assets/images/') . time() . "." . $file_ext)){
            $errors[$j] = 'File not upload : ' . $file_name;
        }
    }
    

    if(count($errors) > 0){
        $_SESSION['logic'] = [
            'status' => 'errors',
            'sms' => $errors
        ];
    } else {
        $_SESSION['logic'] = [
            'status' => 'status',
            'sms' => 'Upload Successfully'
        ];
    }
    header("Location: ". route('file'));
}

?>