<?php
if (isset($_GET['month'])) {
    $month = $_GET['month'];
}
$title = "Transactions";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

$acctNum = $_GET['acctNum'];
$customer = $_GET['customerid'];

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-12">

                <!-- TABLE: LATEST TRANSACTIONS -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Monthly Transactions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0 table-striped">

                                <?php
                                if (isset($month)) {
                                    $result = generateStatement($acctNum, $month);
                                } else {
                                    $result = getTransactions($acctNum);
                                }
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