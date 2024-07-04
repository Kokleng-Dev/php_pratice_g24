<?php 
    $title = "Report Page"; 
    $page = "report";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/header.php") ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/nav.php") ?>


<div class="container py-5">
    <div class="row">
        <div class="col-lg-4 col-6 p-2">
            <a href="<?php echo $burl . "/admin/reports/sale.php" ?>" class="text-white" style="text-decoration:none;">
                <div class="bg-primary p-3 rounded text-center">
                    <h2 class="mb-0">Sale Report</h2>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-6 p-2">
            <a href="<?php echo $burl . "/admin/reports/sale_detail.php" ?>" class="text-white" style="text-decoration:none;">
                <div class="bg-primary p-3 rounded text-center">
                    <h2 class="mb-0">Sale Detail Report</h2>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/web_form/projects/admin/layouts/footer.php") ?>