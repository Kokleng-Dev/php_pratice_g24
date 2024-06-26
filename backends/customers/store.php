<?php
    include('../../configs/global.php');

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $note = $_POST['note'];

    $insertQuery = "INSERT INTO customers (name, phone, note) values('$name','$phone','$note')";



    $mysqli->query($insertQuery);

    $_SESSION['logic'] = [
       'status' => 'success',
       'sms' => "insert successfully"
    ]; 
    header("Location: ". route('customer'));

?>