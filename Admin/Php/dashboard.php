<?php
$title = "Dashboard";

// include functions & files 
include 'db.php';
include 'header.php';
include 'navigation.php';

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
                            <?php echo getAccountType($acctNum) ?>
                            <small> *<?php echo getFourDigits($acctNum) ?></small>
                            <button class="btn btn-sm btn-secondary dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Switch Account
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php
                                for ($i = 0; $i < sizeof($accts); $i++) {
                                    echo '<form action="#" method="post">';
                                    echo '<button class="dropdown-item" type="submit" name="change_acct" value="' . $accts[$i] . '">' . getAccountType($accts[$i]) . ' - xxxxxx' . getFourDigits($accts[$i]) . '</button>';
                                    echo '</form>';
                                }
                                ?>
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
                        <span class="info-box-number">Available: <small> $<?php echo getBalance($acctNum) ?> </small></span>
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
                        <h5 class="card-title">Monthly Recap Report</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Spendings: 1 April, 2021 - 30 April, 2022</strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Your Spendings For April</strong>
                                </p>

                                <div class="progress-group">
                                    Services
                                    <span class="float-right"><b>$160</b></span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->

                                <div class="progress-group">
                                    Merchandise
                                    <span class="float-right"><b>$310</b></span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                                    </div>
                                </div>

                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Restraunts</span>
                                    <span class="float-right"><b>$480</b></span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" style="width: 60%"></div>
                                    </div>
                                </div>

                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    Health Care
                                    <span class="float-right"><b>$250</b></span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
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
                                $result = getTransactions($acctNum);
                                if (!$result) {
                                    echo '<p class="text-center">This account does not have any transactions.</p>';
                                } else {
                                    $num_results = $result->num_rows;
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
                                        echo '<td>' . $row['Timestamp'] . '</td>';
                                        echo '<td>' . $row['Vendor'] . '</td>';
                                        if ($row['Type'] == 'withdraw') {
                                            echo '<td><div class="sparkbar text-danger" data-color="#00a65a" data-height="20">-$' . $row['Amount'] . '</div></td>';
                                        }
                                        if ($row['Type'] == 'deposit') {
                                            echo '<td><div class="sparkbar text-success" data-color="#00a65a" data-height="20">+$' . $row['Amount'] . '</div></td>';
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
                        <a href="transaction-history.php" class="btn btn-sm btn-secondary float-right">View All History</a>
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
<?php include 'footer.php'; ?>