<?php

// include functions & files 
include '../functions/db.php';

if (isset($_POST['edit'])) {
    if (isset($_POST['transaction'])) {
        $editTransaction = filter_input(INPUT_POST, 'transaction');
    }
}

if (isset($_POST['cancelEditTrans'])) {
    if (isset($editTransaction)) {
        $editTransaction = '';
    }
}

if (isset($_POST['editTransSubmit'])) {
    $transactionID = filter_input(INPUT_POST, 'transactionID');
    $vendor = filter_input(INPUT_POST, 'vendor');
    $amount = filter_input(INPUT_POST, 'amount');
    $type = filter_input(INPUT_POST, 'type');
    $acctNum = filter_input(INPUT_POST, 'acctNum');

    editTransaction($transactionID, $amount, $type, $vendor, $acctNum);
}

if (isset($_GET['month'])) {
    $month = $_GET['month'];
}

$title = "Transaction History";

include '../view/header.php';

if (!isset($_SESSION['viewing']) && !isset($_POST['customerid'])) {
    header('Location: users.php');
    exit;
}
include '../view/navigation.php';

if (isset($_POST['customerid'])) {
    $customer = $_POST['customerid'];
    $_SESSION['viewing'] = $customer;
}
$customer = $_SESSION['viewing'];

if (isset($_POST['acctNum'])) {
    $acctNum = $_POST['acctNum'];
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
                        <span class="info-box-number"><a href="user-details.php" class="text-reset stretched-link"><?php echo $data['firstName'] . ' ' . $data['lastName'] ?></a></span>
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
                        <span class="info-box-text">Account
                            <?php
                            if ($acctNum != "all") {
                                $status = getAccountStatus($acctNum);

                                if ($status == 'closed') {
                                    echo '<span class="text-danger">(Closed)</span>';
                                }
                            }
                            ?>

                        </span>
                        <span class="info-box-number">
                            <?php if ($acctNum != "all") {
                                echo getAccountType($acctNum) ?>
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
                                    echo '<form action="#" method="post">';
                                    echo '<input type="hidden" name="customerid" value="' . $customer . '">';
                                    echo '<button class="dropdown-item" type="submit" name="acctNum" value="' . $accts[$i] . '">' . getAccountType($accts[$i]) . ' - *' . getFourDigits($accts[$i]) . '</button>';
                                    echo '</form>';
                                }
                                ?>
                                <form action="#" method="post">
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

        <div class="card card-solid">
            <br />
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <input type="search" id="TransSearch" onkeyup="Searchfunction()" class="form-control form-control-lg" placeholder="Search transactions by name">
                        <div class="input-group-append">
                            <button type="button" onclick="Searchfunction()" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4 transactions">
                <?php if (isset($_GET['msg']) && $_GET['msg'] == 'error') echo '<div class="alert-danger">There was an error updating the transaction</div>' ?>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0 table-hover">

                            <?php

                            if ($acctNum != 'all') {
                                $result = getTransactions($_POST['acctNum']);
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
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while (($row = $result->fetch_assoc())) {

                                        if (isset($editTransaction) && $editTransaction == $row['transactionID']) {
                                    ?>
                                            <tr>
                                                <form action="#" method="post">
                                                    <td><?php echo getAccountType($row['acctNum']) . ' *' . getFourDigits($row['acctNum']) ?></td>
                                                    <td><?php echo $row['date'] . ' ' . $row['time'] ?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="vendor" class="form-control" placeholder="Enter transaction name" value="<?php echo $row['vendor'] ?>" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" name="amount" class="form-control" placeholder="Enter amount" value="<?php echo $row['amount'] ?>" required>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type1" value="deposit" <?php if ($row['type'] == 'deposit') echo 'checked' ?>>
                                                            <label class="form-check-label text-success" for="type1">Deposit</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" class="btn-check" name="type" id="type2" value="withdraw" <?php if ($row['type'] == 'withdraw') echo 'checked' ?>>
                                                            <label class="form-check-label text-danger" for="type2">Withdraw</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="submit" name="editTransSubmit" class="btn btn-sm btn-success"> <i class="fas fa-check-circle"></i></button>
                                                        <br>
                                                        <button type="submit" name="cancelEditTrans" class="btn btn-sm btn-danger mt-2"> <i class="fas fa-times-circle"></i></button>
                                                    </td>

                                                    <input type="hidden" name="acctNum" value="<?php echo $row['acctNum'] ?>">
                                                    <input type="hidden" name="transactionID" value="<?php echo $editTransaction ?>">

                                                </form>


                                            </tr>

                                        <?php
                                        } else {

                                            echo '<tr class="dataRows">';
                                            echo '<td>' . getAccountType($row['acctNum']) . ' *' . getFourDigits($row['acctNum']) . '</td>';
                                            echo '<td>' . $row['date'] . ' ' . $row['time'] . '</td>';
                                            echo '<td class="nameCol">' . $row['vendor'] . '</td>';
                                            if ($row['type'] == 'withdraw') {
                                                echo '<td><div class="sparkbar text-danger" data-color="#00a65a" data-height="20">-$' . $row['amount'] . '</div></td>';
                                            }
                                            if ($row['type'] == 'deposit') {
                                                echo '<td><div class="sparkbar text-success" data-color="#00a65a" data-height="20">+$' . $row['amount'] . '</div></td>';
                                            } ?>
                                            <td>
                                                <form action="#" method="post">
                                                    <input type="hidden" name="transaction" value="<?php echo $row['transactionID'] ?>">
                                                    <input type="hidden" name="acctNum" value="<?php echo $row['acctNum'] ?>">
                                                    <button type="submit" name="edit" class="btn btn-sm btn-primary"> <i class="fas fa-pencil-alt"></i></button>
                                                </form>
                                            </td> <?php
                                                    echo '</tr>';
                                                    $i++;
                                                }
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

                    <a href="#" class="btn btn-sm btn-info float-right" onclick="window.print();return false;">Print Statement</a>
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

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    function Searchfunction() {
        var searchValue = $('#TransSearch').val();
        var TransRows = $('.dataRows');
        var rowsLength = TransRows.length;
        for (var i = 0; i < rowsLength; i++) {
            var singleRow = TransRows[i];
            var TransName = singleRow.getElementsByClassName('nameCol');
            var TransNameValue = $(TransName).text();
            if (!TransNameValue.toLowerCase().includes(searchValue.toLowerCase())) {
                $(singleRow).hide();
            } else {
                $(singleRow).show();
            }

        }

    }
</script>

<!-- footer -->
<?php include '../view/footer.php'; ?>