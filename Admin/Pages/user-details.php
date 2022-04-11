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
                        <a href="edit-info.php" class="btn btn-sm btn-success">
                            <i class="fas fa-pen"></i> Edit Info
                        </a>
                        <a href="edit-info.php" class="btn btn-sm btn-danger float-right">
                            <i class="fas fa-pen"></i> Remove Customer
                        </a>
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
                    <div class="card-body">
                        <h4 class="card-title"><b>Accounts</b></h4>
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
                <!-- TABLE: LATEST TRANSACTIONS -->
                <div class="card card-secondary">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Recent Transactions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">

                                <?php
                                $acctNum = $accts[0];
                                $result = getTransactions($acctNum);
                                $num_results = $result->num_rows;
                                if ($num_results == 0) {
                                    echo '<p class="text-center pt-3">This account does not have any transactions.</p>';
                                } else {
                                    $i = 0;
                                ?>
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while (($row = $result->fetch_assoc()) && ($i < 10)) {
                                        echo '<tr>';
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
                        <a href="bank-transaction.php?customerid=<?php echo $customer ?>" class="btn btn-sm btn-info float-left">Make a Transaction</a>
                        <a href="transaction-history.php" class="btn btn-sm btn-secondary float-right">View All History</a>
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