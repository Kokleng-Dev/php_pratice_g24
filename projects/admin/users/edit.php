<?php 
    $title = "Edit User Page"; 
    $page = "user";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>
<?php
    $user_id = $_GET['user_id'];
    $user = $mysql->query("SELECT * FROM users WHERE id = '$user_id'");
    $user = $user->fetch_object();
?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Edit user</h2>
        </div>
        <div class="card-body">
            <a href="<?php echo $burl . "/admin/users/index.php"; ?>" class="btn btn-danger mb-2"><i class="fa fa-reply"></i> Back</a>
            <?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/sms.php") ?>
            <form action="<?php echo $burl . "/admin/users/actions/edit.php"; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $user->name; ?>" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $user->username; ?>" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="old_password">Old Password</label>
                    <input type="text" class="form-control" name="old_password" value="" id="name">
                </div>
                <div class="mb-3">
                    <label for="password">New Password</label>
                    <input type="text" class="form-control" name="password" value="" id="name">
                </div>
                <div class="mb-3">
                    <label for="photo">photo</label>
                    <input type="file" name="myPhoto" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="photo">Current Photo</label>
                    <img width="100" src="<?php echo $base_url . $user->photo; ?>" alt="">
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                </div>  
            </form>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>