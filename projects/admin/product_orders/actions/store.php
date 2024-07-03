<?php

include( $_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/config.php");

if(isset($_POST['myOrder']) && isset($_POST['myOrderIndex'])){

    $myOrderIndex = $_POST['myOrderIndex'];
    $myOrder = (array) json_decode($_POST['myOrder']);

    $customer_id = $myOrder['customer_id'];
    $orders = $myOrder['orders'];

    // find grand total
    $grandTotal = 0;

    foreach ($orders as $index => $order) {
        // query product detail
        $order = (array) $order;
        $product_id = $order['product_id'];
        $product = $mysql->query("SELECT * FROM products WHERE id = '$product_id'")->fetch_object();
        $grandTotal += ($product->price * $order['qty']);
    }

    $inv_code = time();
    $created_at = date('Y-m-d H:i:s');
    $created_by = $_SESSION['auth'];

    // insert into table product_orders
    $product_order = $mysql->query("
        INSERT INTO product_orders (customer_id,inv_code,grand_total,active,created_at,created_by) 
        VALUES ('$customer_id','$inv_code','$grandTotal','1','$created_at','$created_by')
    ");

    // get product order 
    $product_order = $mysql->query("SELECT * FROM product_orders ORDER BY id DESC LIMIT 1")->fetch_object();
    $product_order_id = $product_order->id;

    // insert into table product_order_details

    foreach ($orders as $index => $order) {
        // query product detail
        $order = (array) $order;
        $product_id = $order['product_id'];
        $qty = $order['qty'];

        $product = $mysql->query("SELECT * FROM products WHERE id = '$product_id'")->fetch_object();

        $price = $product->price;
        $total = ($product->price * $order['qty']);

        $mysql->query("
            INSERT INTO product_order_details (product_order_id,product_id,price,qty,total_price)
            VALUES ('$product_order_id','$product_id','$price','$qty','$total')
        ");
    }

    $customer = $mysql->query("SELECT * FROM customers WHERE id = '$customer_id'")->fetch_object();
    $_SESSION['message'] = [
        'status' => 'success',
        'sms' => 'Order Successfully : ' . $customer->name
    ]; 


    unset($_SESSION['orders'][$myOrderIndex]);

} else {
    $_SESSION['message'] = [
        'status' => 'error',
        'sms' => 'Something Wrong !!'
    ];
}

header("Location: ". $burl . "/admin/product_orders/index.php");

?>