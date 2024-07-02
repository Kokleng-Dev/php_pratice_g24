<?php 
    $title = "Edit Production Category Page"; 
    $page = "category";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $product_category_id = $_GET['product_category_id'];
    $category = $mysql->query("SELECT * FROM product_categories WHERE id = '$product_category_id'");
    $category = $category->fetch_object();
?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Edit category</h2>
        </div>
        <div class="card-body">
            <a href="<?php echo $burl . "/admin/product_categories/index.php"; ?>" class="btn btn-danger mb-2"><i class="fa fa-reply"></i> Back</a>
            <?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/sms.php") ?>
            <form action="<?php echo $burl . "/admin/product_categories/actions/edit.php"; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product_category_id; ?>">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $category->name; ?>" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="photo">photo</label>
                    <input type="file" name="myPhoto" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="photo">Current Photo</label>
                    <img width="100" src="<?php echo $base_url . $category->photo; ?>" alt="">
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                </div>  
            </form>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>