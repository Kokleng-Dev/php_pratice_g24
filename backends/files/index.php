<?php include("../../configs/global.php"); ?>
<?php $title = "File Page"; ?>
<?php include("../layouts/header.php"); ?>
    
    <!-- body  -->
    <div style="padding:12px;">
        <?php include('../../configs/message.php') ?>
        <h1 class="colorPink">hello File Page</h1>
        <form action="<?php echo route('action_file'); ?>" method="POST" enctype="multipart/form-data"> 
            <label for="file">Upload Your File</label>
            <input type="file" accept="application/pdf" multiple name="photo[]" class="form-control" required>
            <br>
            <button class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
        </form>
    </div>

   
                

<?php include("../layouts/bottom.php"); ?>


