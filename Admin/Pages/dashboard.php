<?php
$title = "Dashboard";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-university"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Account</span>
                        <span class="info-box-number">
                            <button class="btn btn-sm btn-secondary dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Switch Account
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            </div>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Balance</span>
                        <span class="info-box-number">Available: <small> $0.00 </small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Pending Accounts</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">

                                <?php
                                $result = getPendingAccts();
                                if (!$result) {
                                    echo '<p class="text-center">There are no pending accounts!</p>';
                                } else {
                                    $num_results = $result->num_rows;
                                    $i = 0;
                                ?>
                                    <thead>
                                        <tr>
                                            <th>Account Number</th>
                                            <th>Customer</th>
                                            <th>Account Type</th>
                                            <th>Date Requested</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while (($row = $result->fetch_assoc()) && ($i < 10)) {
                                            $data = getCustomerData($row['customerID']);
                                            $customerName = $data['firstName'] . ' ' . $data['lastName'];
                                            echo '<tr>';
                                            echo '<td>' . $row['acctNum'] . '</td>';
                                            echo '<td><a href="user-details.php?customerid=' . $row['customerID'] . '">' . $customerName . '</td>';
                                            echo '<td> ' . $row['acctType'] . '</td>';
                                            echo '<td>' . $row['dateCreated'] . '</td>'; ?>
                                            <td>
                                                <form action="../functions/changestatus.php" method="post">
                                                    <input type="hidden" name="acctNum" value="<?php echo $row['acctNum'] ?>">
                                                    <button type="submit" name="approve" class="btn btn-sm btn-success"> <i class="fas fa-check-circle"></i>
                                                    </button>
                                                    <button type="submit" name="deny" class="btn btn-sm btn-danger"> <i class="fas fa-times-circle"></i>
                                                    </button>
                                                </form>
                                            </td>

                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                        $result->free();
                                    }

                                    ?>
                                    </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-12">

                <!-- TABLE: LATEST TRANSACTIONS -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Recent Transactions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">

                                <?php
                                $result = getAllTransactions();
                                if (!$result) {
                                    echo '<p class="text-center">There are no transactions.</p>';
                                } else {
                                    $num_results = $result->num_rows;
                                    $i = 0;
                                ?>
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while (($row = $result->fetch_assoc()) && ($i < 10)) {
                                        $cid = getCustomerDataByAcct($row['acctNum']);
                                        $data = getCustomerData($cid);
                                        $customerName = $data['firstName'] . ' ' . $data['lastName'];

                                        echo '<tr>';
                                        echo '<td><a href="user-details.php?customerid=' . $data['customerID'] . '">' . $customerName . '</td>';
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
                                    $result->free();
                                }

                                    ?>
                                    </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <a href="bank-transaction.php" class="btn btn-sm btn-info float-left">Make a Transaction</a>
                        <a href="transactions.php" class="btn btn-sm btn-secondary float-right">View All History</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->


<!-- footer -->
<?php include '../view/footer.php'; ?>