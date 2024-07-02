<?php 
    $title = "Product Page"; 
    $page = "product";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $per_page = 100;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_page = ($page - 1) * $per_page;

    $countProduct = 0;
    $totalButton = 0;
    $search = '';
    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy']  : 'ASC';
    $keyOrder = isset($_GET['keyOrder']) ? $_GET['keyOrder'] : 'products.name';
    $product = '';

    if(isset($_GET['search']) && $_GET['search'] != ''){
        $search = $_GET['search'];


        $countProduct = $mysql->query("SELECT COUNT(*) as total from products INNER JOIN product_categories ON products.product_category_id = product_categories.id INNER JOIN users ON users.id = products.created_by WHERE products.name LIKE '%$search%' OR product_categories.name LIKE '%$search%' OR products.price LIKE '%$search%' ORDER BY $keyOrder $orderBy")->fetch_object();
        $totalButton = round($countProduct->total / $per_page);

        $products = $mysql->query("SELECT products.* , product_categories.name as product_category_name, users.name as action_by FROM products INNER JOIN product_categories ON products.product_category_id = product_categories.id INNER JOIN users ON users.id = products.created_by WHERE products.name LIKE '%$search%' OR product_categories.name LIKE '%$search%' OR products.price LIKE '%$search%'  ORDER BY $keyOrder $orderBy LIMIT $per_page OFFSET $start_page");

    } else {
        $countProduct = $mysql->query("SELECT COUNT(*) as total from products")->fetch_object();
        $totalButton = round($countProduct->total / $per_page);

        $products = $mysql->query("SELECT products.* , product_categories.name as product_category_name, users.name as action_by FROM products INNER JOIN product_categories ON products.product_category_id = product_categories.id INNER JOIN users ON users.id = products.created_by ORDER BY $keyOrder $orderBy LIMIT $per_page OFFSET $start_page");
    }


    $orderBy = isset($_GET['orderBy']) ? ($_GET['orderBy'] == 'ASC' ? 'DESC' : 'ASC') : 'ASC';


?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Product</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/sms.php") ?>
                    <a href="<?php echo $burl . "/admin/products/create.php"; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item <?php echo $page - 1 == 0 ? 'disabled' : '' ?>"><a class="page-link" href="<?php echo $burl . "/admin/products/index.php?page=" . $page - 1; ?>">Previous</a></li>
                            <?php for($i=1; $i <= $totalButton; $i++){?>
                                <li class="page-item <?php echo $page == $i ? 'active' : ''  ?>">
                                    <a class="page-link" href="<?php echo $burl . "/admin/products/index.php?page=" . $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?php echo $page + 1 > $totalButton ? 'disabled' : ''; ?>"><a class="page-link" href="<?php echo $burl . "/admin/products/index.php?page=" . $page + 1; ?>">Next</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col"></div>
                <div class="col-4">
                    <form action="<?php echo $burl . '/admin/products/index.php' ?>" method="get">
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
                        <th>Category<a href="<?php  echo $burl . '/admin/products/index.php?search=' . $search . '&orderBy=' . $orderBy . '&keyOrder=' . 'product_categories.name';?>" class="sort float-end mx-3"><i class="fas fa-sort"></i></a></th>
                        <th>Name<a href="<?php  echo $burl . '/admin/products/index.php?search=' . $search . '&orderBy=' . $orderBy . '&keyOrder=' . 'products.name';?>" class="sort float-end mx-3"><i class="fas fa-sort"></i></a></th>
                        <th>Price<a href="<?php  echo $burl . '/admin/products/index.php?search=' . $search . '&orderBy=' . $orderBy . '&keyOrder=' . 'products.price';?>" class="sort float-end mx-3"><i class="fas fa-sort"></i></a></th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="vertical-align:middle">
                    <?php $i = 0; ?>
                    <?php while($product = $products->fetch_object()) {  ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td>
                                <?php if($product->photo) { ?>
                                    <img width="50" src="<?php echo $base_url . $product->photo; ?>" alt="">
                                <?php }?>
                            </td>
                            <td><?php echo $product->product_category_name; ?></td>
                            <td><?php echo $product->name; ?></td>
                            <td>$ <?php echo number_format($product->price,2); ?></td>
                            <td><?php echo $product->action_by; ?></td>
                            <td>
                                <a href="<?php echo $burl . "/admin/products/edit.php?product_id=" . $product->id; ?>" class="btn btn-success"><i class="fa fa-pen"></i> Edit</a>
                                <a href="<?php echo $burl . "/admin/products/delete.php?product_id=" . $product->id; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>