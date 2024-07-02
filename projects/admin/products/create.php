<?php 
    $title = "Add Product Page"; 
    $page = "product";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $product_categories = $mysql->query("SELECT * FROM product_categories");
?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Create Product</h2>
        </div>
        <div class="card-body">
            <a href="<?php echo $burl . "/admin/products/index.php"; ?>" class="btn btn-danger mb-2"><i class="fa fa-reply"></i> Back</a>
            <?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/sms.php") ?>
            <form action="<?php echo $burl . "/admin/products/actions/create.php"; ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="product_categories">Category</label>
                    <select class="form-control" name="product_category_id" id="price" required>
                        <option value="">Please Select</option>
                        <?php while($category = $product_categories->fetch_object()){ ?>
                            <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" name="price" id="price" required>
                </div>
                <div class="mb-3">
                    <label for="photo">photo</label>
                    <input type="file" name="myPhoto" class="form-control" required>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                </div>  
            </form>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>