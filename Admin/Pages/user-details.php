<?php
$title = "User Info";

// include functions & files 
include '../functions/db.php';

include '../view/header.php';
include '../view/navigation.php';

$customer = $_GET['customerid'];
$data = getCustomerData($customer);
$accts = getAccountOptions($customer);

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
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
                        <a href="edit-info.php?customerid=<?php echo $customer ?>" class="btn btn-sm btn-success">
                            Edit Info
                        </a>

                        <?php if ($data['status'] == 'active') { ?>
                            <a href="../functions/remove-customer.php?customerid=<?php echo $customer ?>" class="btn btn-sm btn-danger float-right">
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
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Bank Accounts</h3>
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
                                        echo '<a href="statement.php?customerid=' . $customer . '&acctNum=' . $accts[$i] . '" class="text-reset">';
                                        echo getAccountType($accts[$i]);
                                        echo ' *';
                                        echo getFourDigits($accts[$i]);
                                        echo '</a><br>';
                                    }

                                    ?>
                                </p>
                            </div>
                        </div>
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
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="new-bankacct.php?customerid=<?php echo $customer ?>" class="btn btn-sm btn-success">
                            Open a New Account
                        </a>
                        <a href="close-bankacct.php?customerid=<?php echo $customer ?>" class="btn btn-sm btn-danger float-right">
                            Close an Account
                        </a>
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
                                    $acctNum = $accts[0];
                                    $i = 0;
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
                        <a href="bank-transaction.php?customerid=<?php echo $customer ?>" class="btn btn-sm btn-info float-left mr-2">Make a Transaction</a>
                        <a href="make-transfer.php?customerid=<?php echo $customer ?>" class="btn btn-sm btn-info float-left ">Make a Transfer</a>
                        <a href="statement.php?customerid=<?php echo $customer ?>" class="btn btn-sm btn-secondary float-right">View All History</a>
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