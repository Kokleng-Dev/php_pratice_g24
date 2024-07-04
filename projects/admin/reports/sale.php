<?php 
    $title = "Sale Report Page"; 
    $page = "report";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $from = isset($_GET['from']) ? date('Y-m-d H:i:s', strtotime($_GET['from'])) : date('Y-m-d 00:00:00');
    $to = isset($_GET['to']) ? date('Y-m-d H:i:s', strtotime($_GET['to'])) : date('Y-m-d 23:59:59');
    $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : '';

    $query = "SELECT product_orders.*, customers.name as customer_name, users.name as user_name from product_orders 
        INNER JOIN customers ON customers.id = product_orders.customer_id
        INNER JOIN users ON users.id = product_orders.created_by
        WHERE product_orders.created_at >= '$from' AND product_orders.created_at <= '$to' ";

    if($customer_id){
        $query .= "AND customers.id = '$customer_id'";
    }

    $product_order = $mysql->query($query);

    $customers = $mysql->query("SELECT * FROM customers");
?>

<div class="container py-5">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Sale Report</h2>
            </div>
            <div class="card-body">
               <form action="<?php $burl . "/admin/reports/sale.php" ?>" method="get">
               <div class="row">
                    <div class="col-2 m-auto">Customer</div>
                    <div class="col-3">
                        <select name="customer_id" class="form-control">
                            <option value="">Please Select</option>
                            <?php while($customer = $customers->fetch_object()){ ?>
                                <option value="<?php echo $customer->id ?>"><?php echo $customer->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row my-3 bg-warning p-2 rounded">
     
                    <div class="col-1 m-auto">From</div>
                    <div class="col">
                        <input name="from" value="<?php echo $from; ?>" type="datetime-local" class="form-control">
                    </div>
                    <div class="col-1 m-auto">To</div>
                    <div class="col">
                        <input name="to" value="<?php echo $to; ?>" type="datetime-local" class="form-control">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
               </form>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice Code</th>
                            <th>Customer</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; $total = 0; ?>
                        <?php  while($order = $product_order->fetch_object()){?>
                            <?php $total += $order->grand_total; ?>
                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td><?php echo $order->inv_code; ?></td>
                                <td><?php echo $order->customer_name; ?></td>
                                <td><?php echo $order->grand_total; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3" class="text-end">Total</td>
                            <td><?php echo number_format($total,2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>