<?php
$title = "User Info";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';
?>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
        <br />
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            Your Info:
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
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
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?php echo $data['email'] ?></li>

                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="customer_transactions.html" class="btn btn-sm btn-primary">
                                    <i class="fas fa-file"></i> View Transactions
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

<?php include '../view/footer.php' ?>