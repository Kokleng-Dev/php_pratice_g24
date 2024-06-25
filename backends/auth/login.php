<?php include("../../configs/global.php"); ?>
<?php include('../layouts/html_header.php') ?>

<?php
    $logic = [];
    if(isset($_SESSION['logic'])){
        $logic = $_SESSION['logic'];
    }
    if(isset($_SESSION['is_login'])){
        if($_SESSION['is_login'] == true){
            header("Location: " . route('home'));
        }
    }
?>
<div class="container">
    <div class="row">
        <div class="col-12 min-vh-100">
            <div class="row h-100 align-items-center">
                <div class="col-4"></div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0 text-center">Login</h2>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo route('auth.login'); ?>" method="POST">
                                <?php include('../../configs/message.php'); ?>
                                <div class="mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary float-end">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
</div>

<?php include('../layouts/html_bottom.php') ?>

