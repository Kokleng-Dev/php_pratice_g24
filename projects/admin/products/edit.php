<?php 
    $title = "Edit Product Page"; 
    $page = "product";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $product_id = $_GET['product_id'];
    $product = $mysql->query("SELECT * FROM products WHERE id = '$product_id'");
    $product = $product->fetch_object();

    $product_categories = $mysql->query("SELECT * FROM product_categories");
?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Edit product</h2>
        </div>
        <div class="card-body">
            <a href="<?php echo $burl . "/admin/products/index.php"; ?>" class="btn btn-danger mb-2"><i class="fa fa-reply"></i> Back</a>
            <?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/sms.php") ?>
            <form action="<?php echo $burl . "/admin/products/actions/edit.php"; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $product->name; ?>" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="category">Category</label>
                    <select class="form-control" name="product_category_id" id="category" required>
                        <option value="">Please Select</option>
                        <?php  while($product_category = $product_categories->fetch_object()){?>
                            <option value="<?php echo $product_category->id; ?>" <?php echo $product->product_category_id == $product_category->id ? 'selected' : '' ?> ><?php echo $product_category->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" name="price" value="<?php echo $product->price; ?>" id="price" required>
                </div>
                <div class="mb-3">
                    <label for="photo">photo</label>
                    <input type="file" name="myPhoto" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="photo">Current Photo</label>
                    <img width="100" src="<?php echo $base_url . $product->photo; ?>" alt="">
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                </div>  
            </form>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>