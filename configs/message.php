<?php

$logic = [];
if(isset($_SESSION['logic'])){
    $logic = $_SESSION['logic'];

    if($logic['status'] == 'success'){
        echo "<div class='mb-3 alert alert-success'>". $logic['sms'] ."</div>";
    } else if($logic['status'] == 'error'){
        echo "<div class='mb-3 alert alert-danger'>". $logic['sms'] ."</div>";
    } else {
        echo "<div class='mb-3 alert alert-warning'>". $logic['sms'] ."</div>";
    }
    unset($_SESSION['logic']);
}



?>