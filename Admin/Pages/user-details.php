<?php
$title = "User Info";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';

if (!isset($_SESSION['viewing']) && !isset($_POST['customerid'])) {
    header('Location: users.php');
    exit;
}

include '../view/navigation.php';

if addslashes(isset($_POST['customerid'])) {
    $customer = $_POST['customerid'];
    $_SESSION['viewing'] = $customer;
}
$customer = $_SESSION['viewing'];

$data = getCustomerData($customer);
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Personal Information</h3>
                    </div>
                    <div class="card-body">

                        <h4 class="card-title"><b><?php echo $data['firstName'] . ' ' . $data['lastName'] ?></b></h4>
                        <?php if ($data['status'] == 'inactive') {
                        ?>
                            <p class="card-text text-danger">Inactive Customer</p>
                        <?php

                        } else { ?>
                            <p class="card-text">Customer Since <?php echo $data['dateCreated'] ?> </p>
                        <?php
                        }
                        ?>

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
                        <?php if ($data['status'] == 'active') { ?>
                            <a href="edit-info.php" class="btn btn-sm btn-success">
                                Edit Info
                            </a>
                        <?php } ?>

                        <?php if ($data['status'] == 'active') { ?>
                            <a href="../functions/remove-customer.php" class="btn btn-sm btn-danger float-right">
                                Remove Customer
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>

            <!-- Bank Account Details -->
            <div class="col-md-7">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Bank Accounts</h3>
                        <div class="card-tools"></div>
                    </div>
                    <div class="row">
                        <!-- Active accounts -->
                        <div class="col">
                            <div class="card-body">
                                <h4 class="card-title"><b>Active</b></h4>
                                <div class="card-text">
                                    <?php
                                    $accts = getActiveAcctsCustomer($customer);
                                    if (sizeof($accts) == 0) {
                                        echo 'no active accounts <br>';
                                    }
                                    for ($i = 0; $i < sizeof($accts); $i++) {
                                        echo '<form action="statement.php" method="post" class="pt-0 mt-0"><input type="hidden" name="acctNum" value="' . $accts[$i] . '"><input class="btn btn-link p-0 mt-0" type="submit" value="' . getAccountType($accts[$i]) . ' *' . getFourDigits($accts[$i]) . '"></form>';
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- ./active accounts -->

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
                                <div class="card-text">
                                    <?php
                                    $closed = getClosedAcctsCustomer($customer);
                                    if (sizeof($closed) == 0) {
                                        echo 'no closed accounts <br>';
                                    }
                                    for ($i = 0; $i < sizeof($closed); $i++) {
                                        echo '<form action="statement.php" method="post" class="pt-0 mt-0"><input type="hidden" name="acctNum" value="' . $closed[$i] . '"><input class="btn btn-link p-0 mt-0" type="submit" value="' . getAccountType($closed[$i]) . ' *' . getFourDigits($closed[$i]) . '"></form>';
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- ./closed accounts -->

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <?php if ($data['status'] == 'active') { ?>

                            <a href="new-bankacct.php" class="btn btn-sm btn-success">
                                Open a New Account
                            </a>

                            <?php if ($data['status'] == 'active') { ?>

                            <?php } ?>
                            <a href="close-bankacct.php" class="btn btn-sm btn-danger float-right">
                                Close an Account
                            </a>
                        <?php }  ?>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- TABLE: LATEST TRANSACTIONS -->
                <div class="card card-secondary">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Recent Transactions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0 table-hover">

                                <?php
                                $result = getCustomerTransactions($customer);
                                $num_results = $result->num_rows;
                                if ($num_results == 0) {
                                    echo '<p class="text-center pt-3">This customer does not have any transactions.</p>';
                                } else {
                                ?>
                                    <thead>
                                        <tr>
                                            <th>Account</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while (($row = $result->fetch_assoc()) && ($i < 5)) {
                                        echo '<tr>';
                                        echo '<td>' . getAccountType($row['acctNum']) . ' *' . getFourDigits($row['acctNum']) . '</td>';
                                        echo '<td>' . $row['date'] . ' ' . $row['time'] . '</td>';
                                        echo '<td>' . $row['vendor'] . '</td>';
                                        if ($row['type'] == 'withdraw') {
                                            echo '<td><div class="sparkbar text-danger" data-color="#00a65a" data-height="20">-$' . $row['amount'] . '</div></td>';
                                        }
                                        if ($row['type'] == 'deposit') {
                                            echo '<td><div class="sparkbar text-success" data-color="#00a65a" data-height="20">+$' . $row['amount'] . '</div></td>';
                                        }
                                        echo '</tr>';
                                        $i++;
                                    }
                                }
                                $result->free();
                                    ?>
                                    </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <?php if ($data['status'] == 'active') { ?>
                            <a href="bank-transaction.php" class="btn btn-sm btn-info float-left mr-2">Make a Transaction</a>
                            <a href="make-transfer.php" class="btn btn-sm btn-info float-left ">Make a Transfer</a>
                        <?php } ?>

                        <a href="statement.php" class="btn btn-sm btn-secondary float-right">View All History</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <br />
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php include '../view/footer.php' ?>
