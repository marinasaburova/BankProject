<?php
$title = "Users";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Default box -->
        <div class="card card-solid">
            <br />
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="simple-results.html">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-lg" placeholder="Enter Customer Name">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body pb-0">
                <div class="row d-flex align-items-stretch">
                    <?php
                    $result = getAllCustomers();
                    $num_results = $result->num_rows;

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <!-- Customer -->
                        <div class="col-12 col-sm-4 col-md-3 flex-fill">
                            <div class="card bg-light" style="height:250px">
                                <div class="card-body pt-3">
                                    <div class="card-title">
                                        <h2 class="lead"><b><?php echo $row['firstName'] . ' ' . $row['lastName'] ?></b></h2>
                                    </div>
                                    <div class="card-text">
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?php echo $row['email'] ?></li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone: <?php echo $row['phone'] ?></li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $row['addr'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-left">
                                        <a href="customer_transactions.html" class="btn btn-sm btn-primary">
                                            <i class="fas fa-file"></i> View Account
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- ./customer -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php include '../view/footer.php' ?>