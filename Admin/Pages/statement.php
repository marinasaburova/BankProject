<?php
if (isset($_GET['month'])) {
    $month = $_GET['month'];
}


// include functions & files 
include '../functions/db.php';

$title = "Transaction History";

include '../view/header.php';
include '../view/navigation.php';

$customer = $_GET['customerid'];
if (isset($_GET['acctNum'])) {
    $acctNum = $_GET['acctNum'];
} else {
    $acctNum = "all";
}
$accts = getAccountOptions($customer);
$data = getCustomerData($customer);

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-4 col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Customer</span>
                        <span class="info-box-number"><a href="user-details.php?customerid=<?php echo $customer ?>" class="text-reset stretched-link"><?php echo $data['firstName'] . ' ' . $data['lastName'] ?></a></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-4 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-university"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Account</span>
                        <span class="info-box-number">
                            <?php if ($acctNum != "all") { ?>
                                <?php echo getAccountType($acctNum) ?>
                                <small> *<?php echo getFourDigits($acctNum) ?></small>
                            <?php } else {
                                echo '<small>Viewing all accounts</small>';
                            }
                            ?>
                            <button class="btn btn-sm btn-secondary dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Switch Account
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php
                                for ($i = 0; $i < sizeof($accts); $i++) {
                                    echo '<form action="#" method="get">';
                                    echo '<input type="hidden" name="customerid" value="' . $customer . '">';
                                    echo '<button class="dropdown-item" type="submit" name="acctNum" value="' . $accts[$i] . '">' . getAccountType($accts[$i]) . ' - *' . getFourDigits($accts[$i]) . '</button>';
                                    echo '</form>';
                                }
                                ?>
                                <form action="#" method="get">
                                    <input type="hidden" name="customerid" value="<?php echo $customer ?>">
                                    <button class="dropdown-item" type="submit" name="acctNum" value="all">all</button>
                                </form>
                            </div>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-4 col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Balance</span>
                        <span class="info-box-number">
                            <?php
                            if ($acctNum != "all") {
                                echo 'Available: <small> $' . getBalance($acctNum) . '</small>';
                            } else {
                                echo '<small>Pick an account to view balance</small>';
                            }
                            ?>
                        </span>
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

        <!--    <form action="statement.php" method="get">
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
                                    </form> -->


        <div class="card card-solid">
            <br />
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <input type="search" id="UserSearch" onkeyup="Searchfunction()" class="form-control form-control-lg" placeholder="Search transactions">
                        <div class="input-group-append">
                            <button type="button" onclick="Searchfunction()" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0 table-hover">

                            <?php

                            if ($acctNum != 'all') {
                                $result = getTransactions($_GET['acctNum']);
                            } else {
                                $result = getCustomerTransactions($customer);
                            }
                            $num_results = $result->num_rows;
                            if ($num_results == 0) {
                                echo '<p class="text-center">This account does not have any transactions.</p>';
                            } else {
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
                                while (($row = $result->fetch_assoc())) {
                                    echo '<tr>';
                                    echo '<td><a href="statement.php?customerid=' . $customer . '&acctNum=' . $row['acctNum'] . '">' . getAccountType($row['acctNum']) . ' *' . getFourDigits($row['acctNum']) . '</a></td>';
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