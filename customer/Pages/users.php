<?php
$title = "User Info";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

$data = getCustomerData($customer)

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Your Information</h3>
                    </div>
                    <div class="card-body">

                        <h4 class="card-title"><b><?php echo $data['firstName'] . ' ' . $data['lastName'] ?></b></h4>
                        <p class="card-text">Customer Since <?php echo $data['dateCreated'] ?> </p>

                        <h4 class="card-title"><b>Personal Details</b></h4>
                        <p class="card-text">
                        <ul class="ml-4 mb-0 fa-ul">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?php echo $data['email'] ?></li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone: <?php echo $data['phone'] ?></li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $data['addr'] ?></li>

                        </ul>
                        </p>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="edit-info.php" class="btn btn-sm btn-primary">
                                <i class="fas fa-pen"></i> Edit Account Info
                            </a>
                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>

            <!-- Bank Account Details -->
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Your Bank Accounts</h3>
                        <div class="card-tools"></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><b>Your Accounts</b></h4>
                        <p class="card-text">
                            <?php
                            for ($i = 0; $i < sizeof($accts); $i++) {
                                echo getAccountType($accts[$i]);
                                echo ' *';
                                echo getFourDigits($accts[$i]);
                                echo '<br>';
                            }

                            ?>
                        </p>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="edit-info.php" class="btn btn-sm btn-success">
                            <i class="fas fa-pen"></i> Open a New Account
                        </a>
                        <a href="edit-info.php" class="btn btn-sm btn-danger float-right">
                            <i class="fas fa-pen"></i> Close an Account
                        </a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            </div>
        </div>
        <br />
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php include '../view/footer.php' ?>