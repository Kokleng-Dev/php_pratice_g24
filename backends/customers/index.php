<?php include("../../configs/global.php"); ?>
<?php $title = "Customer Page"; ?>

<?php include("../layouts/header.php"); ?>

<?php
    if($_SESSION['is_login'] == false){
        header("Location: ". route('login'));
    }

    $customers = $mysqli->query('select * from customers');
?>



    <!-- modal  -->
    <?php include("create.php") ?>

    <!-- body  -->
    <div style="padding:12px;">
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-users"></i> List of Customer</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <button data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Create</button>
                    </div>
                    <div class="col-12">
                        <?php include('../../configs/message.php'); ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>   
                            <tbody>
                                <?php $i = 1; ?>
                                <?php while($customer = $customers->fetch_object()){?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $customer->name ?></td>
                                        <td><?php echo $customer->phone ?></td>
                                        <td><?php echo $customer->note ?></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success"><i class="fas fa-pen"></i> Edit <?php echo $customer->id ?></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete <?php echo $customer->id ?></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
                

<?php include("../layouts/bottom.php"); ?>


