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
            <div class="col-md-5">
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
                        <a href="edit-info.php" class="btn btn-sm btn-primary">
                            <i class="fas fa-pen"></i> Edit Account Info
                        </a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>

            <!-- Bank Account Details -->
            <div class="col-md-7">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Your Bank Accounts</h3>
                        <div class="card-tools"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card-body">
                                <h4 class="card-title"><b>Active</b></h4>
                                <p class="card-text">
                                    <?php
                                    if (sizeof($accts) == 0) {
                                        echo 'no active accounts <br>';
                                    }
                                    for ($i = 0; $i < sizeof($accts); $i++) {
                                        echo getAccountType($accts[$i]);
                                        echo ' *';
                                        echo getFourDigits($accts[$i]);
                                        echo '<br>';
                                    }

                                    ?>
                                </p>
                            </div>
                        </div>

                        <!-- Pending accounts -->
                        <div class="col">
                            <div class="card-body">
                                <h4 class="card-title"><b>Pending</b></h4>
                                <p class="card-text">
                                    <?php
                                    $pending = getPendingAcctsCustomer($customer);
                                    if (sizeof($pending) == 0) {
                                        echo 'no pending accounts <br>';
                                    }
                                    for ($i = 0; $i < sizeof($pending); $i++) {
                                        echo getAccountType($pending[$i]);
                                        echo ' *';
                                        echo getFourDigits($pending[$i]);
                                        echo '<br>';
                                    }

                                    ?>
                                </p>
                            </div>
                        </div>
                        <!-- ./pending accounts -->

                        <!-- Closed accounts -->
                        <div class="col">
                            <div class="card-body">
                                <h4 class="card-title"><b>Closed</b></h4>
                                <p class="card-text">
                                    <?php
                                    $closed = getClosedAcctsCustomer($customer);
                                    if (sizeof($closed) == 0) {
                                        echo 'no closed accounts <br>';
                                    }
                                    for ($i = 0; $i < sizeof($closed); $i++) {
                                        echo getAccountType($closed[$i]);
                                        echo ' *';
                                        echo getFourDigits($closed[$i]);
                                        echo '<br>';
                                    }

                                    ?>
                                </p>
                            </div>
                        </div>
                        <!-- ./closed accounts -->

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <?php
                        if ($accts) {
                        ?>
                            <a href="new-bankacct.php" class="btn btn-sm btn-success">
                                <i class="fas fa-pen"></i> Open a New Account
                            </a><?php
                            }
                                ?>
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