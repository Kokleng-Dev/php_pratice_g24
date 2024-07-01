<?php 
    $title = "Customer Page"; 
    $page = "customer";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $per_page = 100;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_page = ($page - 1) * $per_page;

    $countCustomer = 0;
    $totalButton = 0;
    $search = '';
    $customer = '';

    if(isset($_GET['search']) && $_GET['search'] != ''){
        $search = $_GET['search'];

        $countCustomer = $mysql->query("SELECT COUNT(*) as total from customers WHERE name LIKE '%$search%'")->fetch_object();
        $totalButton = round($countCustomer->total / $per_page);

        $customers = $mysql->query("SELECT * FROM customers WHERE name LIKE '%$search%' LIMIT $per_page OFFSET $start_page");

    } else {
        $countCustomer = $mysql->query("SELECT COUNT(*) as total from customers")->fetch_object();
        $totalButton = round($countCustomer->total / $per_page);

        $customers = $mysql->query("SELECT * FROM customers LIMIT $per_page OFFSET $start_page");
    }


    // while($customer = $customers->fetch_object()){
    //     var_dump($customer);
    //     echo "<br>";
    // }
    // for($i=0; $i< $customers->num_rows; $i++){
    //     var_dump($customers->fetch_object());
    // }
    // var_dump($customers->fetch_object());
    // var_dump($customers->fetch_object());
    // die();
?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Customer</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/sms.php") ?>
                    <a href="<?php echo $burl . "/admin/customers/create.php"; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item <?php echo $page - 1 == 0 ? 'disabled' : '' ?>"><a class="page-link" href="<?php echo $burl . "/admin/customers/index.php?page=" . $page - 1; ?>">Previous</a></li>
                            <?php for($i=1; $i <= $totalButton; $i++){?>
                                <li class="page-item <?php echo $page == $i ? 'active' : ''  ?>">
                                    <a class="page-link" href="<?php echo $burl . "/admin/customers/index.php?page=" . $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?php echo $page + 1 > $totalButton ? 'disabled' : ''; ?>"><a class="page-link" href="<?php echo $burl . "/admin/customers/index.php?page=" . $page + 1; ?>">Next</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col"></div>
                <div class="col-4">
                    <form action="<?php echo $burl . '/admin/customers/index.php' ?>" method="get">
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
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="vertical-align:middle">
                    <?php $i = 0; ?>
                    <?php while($customer = $customers->fetch_object()) {  ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td>
                                <?php if($customer->photo) { ?>
                                    <img width="50" src="<?php echo $base_url . $customer->photo; ?>" alt="">
                                <?php }?>
                            </td>
                            <td><?php echo $customer->name; ?></td>
                            <td>
                                <a href="<?php echo $burl . "/admin/customers/edit.php?customer_id=" . $customer->id; ?>" class="btn btn-success"><i class="fa fa-pen"></i> Edit</a>
                                <a href="<?php echo $burl . "/admin/customers/delete.php?customer_id=" . $customer->id; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>