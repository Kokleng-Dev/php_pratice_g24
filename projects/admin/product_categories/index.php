<?php 
    $title = "Category Page"; 
    $page = "category";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $per_page = 100;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_page = ($page - 1) * $per_page;

    $countCategory = 0;
    $totalButton = 0;
    $search = '';
    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy']  : 'ASC';
    $category = '';

    if(isset($_GET['search']) && $_GET['search'] != ''){
        $search = $_GET['search'];

        $countCategory = $mysql->query("SELECT COUNT(*) as total from product_categories WHERE name LIKE '%$search%' ORDER BY name $orderBy")->fetch_object();
        $totalButton = round($countCategory->total / $per_page);

        $product_categories = $mysql->query("SELECT * FROM product_categories WHERE name LIKE '%$search%'  ORDER BY name $orderBy LIMIT $per_page OFFSET $start_page");

    } else {
        $countCategory = $mysql->query("SELECT COUNT(*) as total from product_categories")->fetch_object();
        $totalButton = round($countCategory->total / $per_page);

        $product_categories = $mysql->query("SELECT * FROM product_categories ORDER BY name $orderBy LIMIT $per_page OFFSET $start_page");
    }


    $orderBy = isset($_GET['orderBy']) ? ($_GET['orderBy'] == 'ASC' ? 'DESC' : 'ASC') : 'ASC';

    // while($category = $product_categories->fetch_object()){
    //     var_dump($category);
    //     echo "<br>";
    // }
    // for($i=0; $i< $product_categories->num_rows; $i++){
    //     var_dump($product_categories->fetch_object());
    // }
    // var_dump($product_categories->fetch_object());
    // var_dump($product_categories->fetch_object());
    // die();
?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Category</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/sms.php") ?>
                    <a href="<?php echo $burl . "/admin/product_categories/create.php"; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item <?php echo $page - 1 == 0 ? 'disabled' : '' ?>"><a class="page-link" href="<?php echo $burl . "/admin/product_categories/index.php?page=" . $page - 1; ?>">Previous</a></li>
                            <?php for($i=1; $i <= $totalButton; $i++){?>
                                <li class="page-item <?php echo $page == $i ? 'active' : ''  ?>">
                                    <a class="page-link" href="<?php echo $burl . "/admin/product_categories/index.php?page=" . $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?php echo $page + 1 > $totalButton ? 'disabled' : ''; ?>"><a class="page-link" href="<?php echo $burl . "/admin/product_categories/index.php?page=" . $page + 1; ?>">Next</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col"></div>
                <div class="col-4">
                    <form action="<?php echo $burl . '/admin/product_categories/index.php' ?>" method="get">
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
                        <th>Name<a href="<?php  echo $burl . '/admin/product_categories/index.php?search=' . $search . '&orderBy=' . $orderBy;?>" class="sort float-end mx-3"><i class="fas fa-sort"></i></a></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="vertical-align:middle">
                    <?php $i = 0; ?>
                    <?php while($category = $product_categories->fetch_object()) {  ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td>
                                <?php if($category->photo) { ?>
                                    <img width="50" src="<?php echo $base_url . $category->photo; ?>" alt="">
                                <?php }?>
                            </td>
                            <td><?php echo $category->name; ?></td>
                            <td>
                                <a href="<?php echo $burl . "/admin/product_categories/edit.php?product_category_id=" . $category->id; ?>" class="btn btn-success"><i class="fa fa-pen"></i> Edit</a>
                                <a href="<?php echo $burl . "/admin/product_categories/delete.php?product_category_id=" . $category->id; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>