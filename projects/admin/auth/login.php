<?php 
    $title = "Login Page"; 
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>

<?php
    if($_SESSION['login'] == true){
        header("Location: " . $burl . "/admin/index.php");
    }
?>
<form action="<?php echo $burl . "/admin/auth/action_login.php" ?>" method="POST">
    <div class="container-fluid bg-primary-subtle">
        <div class="row min-vh-100 d-flex justify-content-center align-items-center">
            <div class="col-4"></div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0 text-center">Login</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input id="username" type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" class="form-control" required>
                        </div>
                        <button class="btn btn-primary float-end"><i class="fas fa-sign-in-alt"></i> Login</button>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</form>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>