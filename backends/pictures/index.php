<?php include("../../configs/global.php"); ?>
<?php $title = "Photo Page"; ?>
<?php include("../layouts/header.php"); ?>
    
    <!-- body  -->
    <div style="padding:12px;">
        <form action="<?php echo route('action_picture'); ?>" method="POST" enctype="multipart/form-data">
            <input type="file" name="myPhoto" required>
            <button>Submit</button>
        </form>
    </div>

   
                

<?php include("../layouts/bottom.php"); ?>


