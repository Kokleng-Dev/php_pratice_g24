<?php 
    $title = "Print Page"; 
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $product_order_id = $_GET['product_order_id'];

    $product_order = $mysql->query("
        SELECT product_orders.*, customers.name as customer_name, users.name as user_name from product_orders 
        INNER JOIN customers ON customers.id = product_orders.customer_id
        INNER JOIN users ON users.id = product_orders.created_by
        WHERE product_orders.id = '$product_order_id' LIMIT 1
    ")->fetch_object();


    $product_order_details = $mysql->query("
        SELECT product_order_details.*, products.name as product_name FROM product_order_details 
        INNER JOIN products ON products.id = product_order_details.product_id
        WHERE product_order_details.product_order_id = '$product_order_id'
    ");

    $company = $mysql->query("SELECT * FROM company")->fetch_object();

?>

<div class="p-0-print">
    <div class="row">
        <div class="col-12 d-none-print">
            <a class="btn btn-danger" href="<?php echo $burl . "/admin/product_orders/index.php" ?>"><i class="fa fa-reply"></i> Back</a>
            <button onclick="window.print()" type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
        </div>
        <div class="col-lg-3 col-12 py-2 pb-5 zoom">
            <div class="w-100 text-center">
                <img src="<?php echo $company->photo; ?>" class="logo rounded-circle border border-1">
            </div>
        </div>
        <div class="col-lg-9 col-12 d-flex justify-contents-center align-items-center zoom">
            <div class="w-100">
                <h2 class="text-center mb-4"><?php echo $company->name; ?></h2>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td>
                                <h5>Phone : 0199129192</h5>
                            </td>
                            <td>
                                Bill to : <?php echo $product_order->customer_name; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Address : Phnom Penh</h5>
                            </td>
                            <td>
                                Sale By : <?php echo $product_order->user_name; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12">
            <h4 class="text-start zoom"> Invoice No : <?php echo $product_order->inv_code; ?> </h4>
        </div>
        <div class="col-12">
            <table class="table table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;?>
                    <?php while($product_order_detail = $product_order_details->fetch_object()){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $product_order_detail->product_name;?></td>
                            <td>$<?php echo number_format($product_order_detail->price,2); ?></td>
                            <td><?php echo $product_order_detail->qty; ?></td>
                            <td>$<?php echo number_format($product_order_detail->total_price,2); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" class="text-end">Grand Total : </td>
                        <td>$<?php echo number_format($product_order->grand_total,2) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    window.print();
</script>


<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>