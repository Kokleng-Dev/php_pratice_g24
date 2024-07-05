<?php 
    $title = "Home Page"; 
    $page = "home";
?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php"); ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>

<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/sms.php") ?>

<?php 
    $total_sale = $mysql->query("SELECT COUNT(*) as total FROM product_orders")->fetch_object()->total;
    $total_customer = $mysql->query("SELECT COUNT(*) as total FROM customers")->fetch_object()->total;
    $total_income = $mysql->query("SELECT SUM(grand_total) as total FROM product_orders")->fetch_object()->total;
    $from = date('Y-m-d 00:00:00');
    $to = date('Y-m-d 23:59:59');

    $total_income_today = $mysql->query("
        SELECT SUM(grand_total) as total FROM product_orders 
        WHERE created_at >= '$from' AND created_at <= '$to'
    ")->fetch_object()->total;
?>

<div class="row p-3">
    <div class="col-lg-3 col-md-6 col-12 p-3">
        <div class="p-3 bg-primary rounded">
           <h5 class="mb-0 text-center text-white"><i class="fas fa-chart-bar"></i> Total Sale</h5>
           <h1 class="mb-0 text-center text-white"><?php echo $total_sale; ?></h1>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 p-3">
        <div class="p-3 bg-success rounded">
            <div class="row">
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <i class="fas fa-users fs-1 text-white"></i> 
                </div>
                <div class="col">
                    <h5 class="mb-0 text-center text-white">Total Customer</h5>
                    <h1 class="mb-0 text-center text-white"><?php echo $total_customer; ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 p-3">
        <div class="p-3 bg-dark rounded">
           <h5 class="mb-0 text-center text-white"><i class="fas fa-hand-holding-usd"></i> Total Income</h5>
           <h1 class="mb-0 text-center text-white"><?php echo $total_income; ?></h1>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 p-3">
        <div class="p-3 bg-warning rounded">
           <h5 class="mb-0 text-center text-white"><i class="fas fa-comments-dollar"></i> Total Income Today</h5>
           <h1 class="mb-0 text-center text-white"><?php echo $total_income_today; ?></h1>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php"); ?>