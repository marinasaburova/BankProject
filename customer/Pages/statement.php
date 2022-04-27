<?php
$month = $_GET['month'];
$title = "Statement for $month";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

$acctNum = $_GET['acctNum'];
$data = getCustomerData($customer)

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Account Info</h3>
                        <a href="transaction-history.php" class="btn btn-sm btn-secondary float-right mx-2">Switch Month</a>

                        <a href="#" class="btn btn-sm btn-info float-right" onclick="window.print();return false;">Print Statement</a>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <p class="my-0"><b>Name:</b> <?php echo $data['firstName'] . ' ' . $data['lastName'] ?></p>
                            <p class="my-0"><b>Account:</b> <?php echo getAccountType($acctNum) ?> *<?php echo getFourDigits($acctNum) ?></p>
                            <p class="my-0"><b>Month:</b> <?php echo $month ?></p>
                        </div>
                    </div>
                </div>
                <!-- TABLE: LATEST TRANSACTIONS -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Transactions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">

                                <?php
                                $result = generateStatement($acctNum, $month);
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
                                    while (($row = $result->fetch_assoc())) {
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