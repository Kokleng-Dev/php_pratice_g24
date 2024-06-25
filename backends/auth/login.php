<?php include("../../configs/global.php"); ?>
<?php include('../layouts/html_header.php') ?>
<?php
    $status = -1;
    $sms = "";

    if(isset($_GET['status']) && isset($_GET['sms'])){
        $status = $_GET['status'];
        $sms = $_GET['sms'];
    }

    if(isset($_COOKIE['auth'])){
        if($_COOKIE['auth'] == true && $status != -2 ){
            header("Location: ". route('home'));
        } else {
            setcookie('auth',false,time() - 1000);
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
                                <?php if($status == 0){ ?>
                                    <div class="mb-3 alert alert-danger">
                                        <?php echo $sms; ?>
                                    </div>
                                <?php } ?>
                                <?php if($status == -2){ ?>
                                    <div class="mb-3 alert alert-success">
                                        <?php echo $sms; ?>
                                    </div>
                                <?php } ?>
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

