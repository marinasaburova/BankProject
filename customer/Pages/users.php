<?php
$title = "User Info";

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
            <div class="card-body pb-0">
                <div class="col-sm-6">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            Your Info:
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <?php $data = getCustomerData($customer) ?>
                                    <h2 class="lead"><b><?php echo $data['firstName'] . ' ' . $data['lastName'] ?></b></h2>
                                    <p class="text-muted text-sm"><b>Accounts: </br></b>
                                        <?php
                                        for ($i = 0; $i < sizeof($accts); $i++) {
                                            echo getAccountType($accts[$i]);
                                            echo ' *';
                                            echo getFourDigits($accts[$i]);
                                            echo '<br>';
                                        }

                                        ?>
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?php echo $data['email'] ?></li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone: <?php echo $data['phone'] ?></li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $data['addr'] ?></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="edit-info.php" class="btn btn-sm btn-primary">
                                    <i class="fas fa-pen"></i> Edit Account Info
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php include '../view/footer.php' ?>