<?php 
    $title = "Product Order Page"; 
    $page = "order";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $products = $mysql->query("SELECT * FROM products");   
    $customers = $mysql->query("SELECT * FROM customers");
    if(isset($_SESSION['orders'])){
        if(isset($_POST['customer_id']) && isset($_POST['product_id']) && isset($_POST['qty'])){
            $customer_id = $_POST['customer_id'];
            $product_id = $_POST['product_id'];
            $qty = $_POST['qty'];

            if(count($_SESSION['orders']) == 0){
                array_push($_SESSION['orders'], [
                    'customer_id' => $customer_id,
                    'orders' => [
                        ['customer_id' => $customer_id, 'product_id' => $product_id, 'qty' => $qty]
                    ]
                ]);
            } else {
                $isExist = false;
                foreach ($_SESSION['orders'] as $index => $order) {
                    if($order['customer_id'] == $customer_id){
                        $checkDuplicateItem = false;
                        foreach ($order['orders'] as $jdex => $orderItem) {
                            if($orderItem['product_id'] == $product_id){
                                $_SESSION['orders'][$index]['orders'][$jdex]['qty'] += $qty;
                                $checkDuplicateItem = true;
                            }
                        }
                        if($checkDuplicateItem == false){
                            array_push($_SESSION['orders'][$index]['orders'], ['customer_id' => $customer_id, 'product_id' => $product_id, 'qty' => $qty]);
                        }

                        $isExist = true;
                        break;
                    }
                }
                if($isExist == false){
                    array_push($_SESSION['orders'], [
                        'customer_id' => $customer_id,
                        'orders' => [
                            ['customer_id' => $customer_id, 'product_id' => $product_id, 'qty' => $qty]
                        ]
                    ]);
                }
            }

        }
    } else {
        $_SESSION['orders'] = [];
    }
    // $_SESSION['orders'] = [];

    // print_r($_SESSION['orders']);


    // add more item
    if(isset($_POST['add_customer_id']) && isset($_POST['add_product_id'])){
        $add_customer_id = $_POST['add_customer_id'];
        $add_product_id = $_POST['add_product_id'];
        
        foreach ($_SESSION['orders'] as $index => $order) {
            if($order['customer_id'] == $add_customer_id){
                foreach ($order['orders'] as $jdex => $value) {
                    if($value['product_id'] == $add_product_id){
                        $_SESSION['orders'][$index]['orders'][$jdex]['qty']++;
                        break;
                    }
                }
            }
        }
    }

    // decrease qty
    if(isset($_POST['decrease_customer_id']) && isset($_POST['decrease_product_id'])){
        $decrease_customer_id = $_POST['decrease_customer_id'];
        $decrease_product_id = $_POST['decrease_product_id'];
        
        foreach ($_SESSION['orders'] as $index => $order) {
            if($order['customer_id'] == $decrease_customer_id){
                foreach ($order['orders'] as $jdex => $value) {
                    if($value['product_id'] == $decrease_product_id){
                        $_SESSION['orders'][$index]['orders'][$jdex]['qty']--;
                        if($_SESSION['orders'][$index]['orders'][$jdex]['qty'] == 0){

                            // remove item which is 0
                            $orderDetails = $_SESSION['orders'][$index]['orders'];
                            $_SESSION['orders'][$index]['orders'] = [];
                            $i = 0;
                            foreach ($orderDetails as $kdex => $kValue) {
                                if($kValue['qty'] > 0){
                                    $_SESSION['orders'][$index]['orders'][$i] = $kValue;
                                    $i++;
                                }
                            }

                            // check if this customers's order is empty -> remove customer from order list
                            if(count($_SESSION['orders'][$index]['orders']) == 0){
                                $allOrders = $_SESSION['orders'];
                                $_SESSION['orders'] = [];
                                $j = 0;
                                foreach ($allOrders as $orderKey => $orderCustomer) {
                                    if($orderKey != $index){
                                        $_SESSION['orders'][$j] = $orderCustomer;
                                        $j++;
                                    }
                                }
                            }

                        }
                        break;
                    }
                }
            }
        }
    }

    // delete all of item
    if(isset($_POST['delete_customer_id']) && isset($_POST['delete_product_id'])){

        $delete_customer_id = $_POST['delete_customer_id'];
        $delete_product_id = $_POST['delete_product_id'];

        foreach ($_SESSION['orders'] as $index => $order) {
            if($order['customer_id'] == $delete_customer_id){
                foreach ($order['orders'] as $jdex => $orderItem) {
                    if($orderItem['product_id'] == $delete_product_id){
                        unset($_SESSION['orders'][$index]['orders'][$jdex]);

                        if(count($_SESSION['orders'][$index]['orders']) == 0){
                            unset($_SESSION['orders'][$index]);
                        }

                        break;
                    }
                }
            }
        }

    }
  
    // foreach ($_SESSION['orders'] as $key => $value) {
    //     print_r($value);
    //     echo "<br>";
    // }
?>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-12">
            <?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/sms.php") ?>
        </div>
        <div class="col-12">
            <form action="<?php echo $burl . "/admin/product_orders/index.php" ?>" method="POST">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-cart-plus"></i> Order</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                    <label for="customer">Customer</label>
                                    <select name="customer_id" id="customer" required class="form-select">
                                        <option value="">Please Select</option>
                                        <?php while($customer = $customers->fetch_object()){ ?>
                                            <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="product">Product / Item</label>
                                <select name="product_id" id="product" required class="form-select">
                                    <option value="">Please Select</option>
                                    <?php while($product = $products->fetch_object()){ ?>
                                        <option value="<?php echo $product->id; ?>"><?php echo $product->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="qty">Qty</label>
                                <input type="number" name="qty" class="form-control" placeholder="input qty of item" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-cart-arrow-down"></i> Add To Cart</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- list order  -->
        <?php foreach ($_SESSION['orders'] as $index => $order) { ?>
            <?php
                $cus_id = $order['customer_id'];
                $cus = $mysql->query("SELECT * FROM customers WHERE id = '$cus_id'")->fetch_object();
            ?>
            <form action="<?php echo $burl . "/admin/product_orders/actions/store.php" ?>" method="post">
                <input type="hidden" name="myOrder" value='<?php echo json_encode($order); ?>'>
                <input type="hidden" name="myOrderIndex" value="<?php echo $index; ?>">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h2 class="mb-0 text-white"><i class="fas fa-shopping-cart"></i> List Orders of <span class="text-warning"><?php echo $cus->name; ?></span></h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover text-center">
                                <thead class="table-success">
                                    <tr>
                                        <th>Action</th>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1; 
                                        $grand_total = 0;
                                    ?>
                                    <?php foreach ($order['orders'] as $key => $orderitem) {?>
                                        <?php
                                            $product_id = $orderitem['product_id'];
                                            $product = $mysql->query("SELECT * FROM products WHERE id = '$product_id'")->fetch_object();
                                        ?>
                                        <tr>
                                            <td>
                                                <form action="<?php $burl . "/admin/product_orders"; ?>" method="POST">
                                                    <input type="hidden" name="delete_customer_id" value="<?php echo $cus_id; ?>">
                                                    <input type="hidden" name="delete_product_id" value="<?php echo $product_id; ?>">
                                                    <button class="btn btn-danger btn-sm mx-2"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $product->name; ?></td>
                                            <td>$<?php echo $product->price; ?></td>
                                            <td>
                                            <div class="row">
                                                    <div class="col text-end">
                                                        <form action="<?php $burl . "/admin/product_orders"; ?>" method="POST">
                                                            <input type="hidden" name="decrease_customer_id" value="<?php echo $cus_id; ?>">
                                                            <input type="hidden" name="decrease_product_id" value="<?php echo $product_id; ?>">
                                                            <button class="btn btn-danger btn-sm mx-2">-</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-2">
                                                        <?php echo $orderitem['qty']; ?>
                                                    </div>
                                                    <div class="col text-start">
                                                        <form action="<?php $burl . "/admin/product_orders"; ?>" method="POST">
                                                            <input type="hidden" name="add_customer_id" value="<?php echo $cus_id; ?>">
                                                            <input type="hidden" name="add_product_id" value="<?php echo $product_id; ?>">
                                                            <button class="btn btn-primary btn-sm mx-2">+</button>
                                                        </form>
                                                    </div>
                                            </div>
                                            </td>
                                            <td>$<?php echo number_format(($product->price * $orderitem['qty']),2); ?></td>
                                        </tr>
                                        <?php
                                            $grand_total += ($product->price * $orderitem['qty']);
                                        ?>
                                    <?php }?>
                                    <tr>
                                        <td colspan="5" class="text-end">Grand Total</td>
                                        <td>$<?php echo number_format($grand_total,2); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-warning"><i class="fa fa-save"></i> Checkout</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>