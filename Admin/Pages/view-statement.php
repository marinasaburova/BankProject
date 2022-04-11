<html>
<?php
$month = $_GET['month'];
$title = "Statement for $month";

// include functions & files 
// hi
include 'db.php';
include 'header.php';

$acctNum = $_SESSION['account']; 
    ?>

<body>
    <!-- menu -->
    <?php include 'menu.php'; ?> <br>

    <div class="wrapper">

        <!-- loop through data to show latest transactions -->
        <h2>Transactions for <?php echo $month ?> </h2>
        <div class="trans">
            <?php
            $result = generateStatement($acctNum, $month);
            $num_results = $result->num_rows;
            if ($num_results == 0) {
                echo '<p>This account does not have any transactions.</p>';
            } else {
                ?>
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
                                        $num_results = $result->num_rows;
                                        if ($num_results == 0) {
                                            echo '<p class="text-center">This account does not have any transactions.</p>';
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
            <?php
                }
            $result->free();
            ?>
        </div>

    </div>

    <!-- footer -->
    <?php include 'footer.php'; ?>

</body>

</html>