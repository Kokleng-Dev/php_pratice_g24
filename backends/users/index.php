<?php include("../../configs/global.php"); ?>
<?php $title = "User Page"; ?>

<?php include("../layouts/header.php"); ?>

    <!-- modal  -->
    <?php include("create.php") ?>
    
    <!-- body  -->
    <div style="padding:12px;">
        <h1 class="colorPink">hello</h1>
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-users"></i> List of User</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <button data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Create</button>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>   
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Hello</td>
                                    <td>01929129129</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success"><i class="fas fa-pen"></i> Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
                

<?php include("../layouts/bottom.php"); ?>


