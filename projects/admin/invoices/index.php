<?php 
    $title = "Invoice Page"; 
    $page = "invoice";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $per_page = 100;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_page = ($page - 1) * $per_page;

    $countProductOrder = 0;
    $totalButton = 0;
    $search = '';
    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy']  : 'ASC';
    $keyOrder = isset($_GET['keyOrder']) ? $_GET['keyOrder'] : 'product_orders.inv_code';
    $productOrder = '';

    if(isset($_GET['search']) && $_GET['search'] != ''){
        $search = $_GET['search'];

        $countProductOrder = $mysql->query("
            SELECT COUNT(*) as total FROM product_orders
            INNER JOIN customers ON customers.id = product_orders.customer_id
            LEFT JOIN users ON users.id = product_orders.created_by
            WHERE product_orders.inv_code LIKE '%$search%' OR 
            customers.name LIKE '%$search%' OR 
            users.name LIKE '%$search%' OR
            product_orders.grand_total LIKE '%$search%'  AND
            product_orders.active = 1
            ORDER BY $keyOrder $orderBy
        ")->fetch_object();

        $totalButton = round($countProductOrder->total / $per_page);

        $productOrders = $mysql->query("
            SELECT product_orders.*, customers.name as customer_name, users.name as user_name from product_orders 
            INNER JOIN customers ON customers.id = product_orders.customer_id
            LEFT JOIN users ON users.id = product_orders.created_by
            WHERE product_orders.inv_code LIKE '%$search%' OR 
            customers.name LIKE '%$search%' OR 
            users.name LIKE '%$search%' OR
            product_orders.grand_total LIKE '%$search%' AND
            product_orders.active = 1
            ORDER BY $keyOrder $orderBy
            LIMIT $per_page OFFSET $start_page
        ");

    } else {
        $countProductOrder = $mysql->query("SELECT COUNT(*) as total from product_orders")->fetch_object();
        $totalButton = round($countProductOrder->total / $per_page);

        $productOrders = $mysql->query("
            SELECT product_orders.*, customers.name as customer_name, users.name as user_name from product_orders 
            INNER JOIN customers ON customers.id = product_orders.customer_id
            LEFT JOIN users ON users.id = product_orders.created_by
            WHERE product_orders.active = 1
            ORDER BY $keyOrder $orderBy
            LIMIT $per_page OFFSET $start_page
        ");
    }


    $orderBy = isset($_GET['orderBy']) ? ($_GET['orderBy'] == 'ASC' ? 'DESC' : 'ASC') : 'ASC';


?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Invoice</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/sms.php") ?>
                    <a href="<?php echo $burl . "/admin/product_orders/index.php"; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item <?php echo $page - 1 == 0 ? 'disabled' : '' ?>"><a class="page-link" href="<?php echo $burl . "/admin/product_orders/index.php?page=" . $page - 1; ?>">Previous</a></li>
                            <?php for($i=1; $i <= $totalButton; $i++){?>
                                <li class="page-item <?php echo $page == $i ? 'active' : ''  ?>">
                                    <a class="page-link" href="<?php echo $burl . "/admin/product_orders/index.php?page=" . $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?php echo $page + 1 > $totalButton ? 'disabled' : ''; ?>"><a class="page-link" href="<?php echo $burl . "/admin/product_orders/index.php?page=" . $page + 1; ?>">Next</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col"></div>
                <div class="col-4">
                    <form action="<?php echo $burl . '/admin/invoices/index.php' ?>" method="get">
                        <div class="input-group">
                            <!-- <input type="hidden" value="<?php echo $page; ?>" name="page"> -->
                            <span class="input-group-text">Search</span>
                            <input type="search" name="search" value="<?php echo $search; ?>" class="form-control">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-sm table-hover table-bordered text-center">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Invoice Code<a href="<?php  echo $burl . '/admin/invoices/index.php?search=' . $search . '&orderBy=' . $orderBy . '&keyOrder=' . 'product_orders.inv_code';?>" class="sort float-end mx-3"><i class="fas fa-sort"></i></a></th>
                        <th>Customer<a href="<?php  echo $burl . '/admin/invoices/index.php?search=' . $search . '&orderBy=' . $orderBy . '&keyOrder=' . 'customers.name';?>" class="sort float-end mx-3"><i class="fas fa-sort"></i></a></th>
                        <th>Total<a href="<?php  echo $burl . '/admin/invoices/index.php?search=' . $search . '&orderBy=' . $orderBy . '&keyOrder=' . 'product_orders.grand_total';?>" class="sort float-end mx-3"><i class="fas fa-sort"></i></a></th>
                        <th>Sale By<a href="<?php  echo $burl . '/admin/invoices/index.php?search=' . $search . '&orderBy=' . $orderBy . '&keyOrder=' . 'users.name';?>" class="sort float-end mx-3"><i class="fas fa-sort"></i></a></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="vertical-align:middle">
                    <?php $i = 0; ?>
                    <?php while($productOrder = $productOrders->fetch_object()) {  ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $productOrder->inv_code; ?></td>
                            <td><?php echo $productOrder->customer_name; ?></td>
                            <td>$<?php echo number_format($productOrder->grand_total,2); ?></td>
                            <td><?php echo $productOrder->user_name; ?></td>
                            <td>
                                <a target="_blank" href="<?php echo $burl . "/admin/product_orders/print.php?product_order_id=" . $productOrder->id; ?>" class="btn btn-dark"><i class="fa fa-print"></i> Print</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>