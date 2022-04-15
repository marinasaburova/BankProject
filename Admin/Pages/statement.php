<?php
if (isset($_GET['month'])) {
    $month = $_GET['month'];
}


// include functions & files 
include '../functions/db.php';

$customer = $_GET['customerid'];
$data = getCustomerData($customer);
$title = "Transactions for " . $data['firstName'] . " " . $data['lastName'];

include '../view/header.php';
include '../view/navigation.php';

if (isset($_GET['acctNum'])) {
    $acctNum = $_GET['acctNum'];
} else {
    $accts = getAccountOptions($customer);
    $acctNum = $accts[0];
}

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-white">
                            <div class="card-header">
                                <h3 class="card-title">Filter</h3>
                            </div>
                            <div class="card-body">
                                <div class="pick">
                                    <form action="statement.php" method="get">
                                        <div class="form-group">
                                            <input type="month" name="month" id="month" class="form-control custom-select" />
                                        </div>
                                        <div class="form-group">
                                            <select id="acctNum" name="acctNum" class="form-control custom-select" required>
                                                <?php getAccountDropdown($customer); ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="customerid" value="<?php echo $customer ?>">
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-success">Generate Statement</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- ./row -->

                <!-- TABLE: LATEST TRANSACTIONS -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Transactions</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0 table-striped">

                                <?php

                                if (isset($month)) {
                                    $result = generateStatement($acctNum, $month);
                                } else {
                                    $result = getTransactionsCustomer($customer);
                                }
                                $num_results = $result->num_rows;
                                if ($num_results == 0) {
                                    echo '<p class="text-center">This account does not have any transactions.</p>';
                                } else {
                                    $i = 0;
                                ?>
                                    <thead>
                                        <tr>
                                            <th>Bank Account</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while (($row = $result->fetch_assoc())) {
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
                        <a href="#" class="btn btn-sm btn-info float-left" onclick="window.print();return false;">Print Statement</a>
                        <a href="transaction-history.php?customerid=<?php $customer ?>" class="btn btn-sm btn-secondary float-right">Switch Month</a>
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