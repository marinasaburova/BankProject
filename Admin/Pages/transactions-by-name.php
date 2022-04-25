<?php
$title = "All Transactions";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';
$searchedFirstName = $_POST['FirstName'];
$searchedLastName = $_POST['LastName'];
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Default box -->
        <div class="card card-solid">
            <br />
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <input type="search" id="TransSearch" onkeyup="Searchfunction()" class="form-control form-control-lg" placeholder="Search Transactions By Date">
                        <div class="input-group-append">
                            <button type="button" onclick="Searchfunction()" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table m-0 table-hover">

                        <?php
                        
                        $result = getTransactionsByName($searchedFirstName,$searchedLastName);
                        if (!$result) {
                            echo '<p class="text-center">There are no transactions.</p>';
                        } else {
                            $num_results = $result->num_rows;
                            $i = 0;
                        ?>
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Account</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $selectedCustomerID = '';
                            while (($rowCustomerID = $result->fetch_assoc())) {
                                $selectedCustomerID = $rowCustomerID['customerID'];
                            }
                            $result->free();
                            $result2 = getCustomerTransactions($selectedCustomerID);
                                while (($row = $result2->fetch_assoc())) { 
                                    $cid = getCustomerUsingAcct($row['acctNum']);
                                    $data = getCustomerData($cid);
                                    $customerName = $data['firstName'] . ' ' . $data['lastName'];

                                    echo '<tr class = "dataRows">';
                                    echo '<td><a href="statement.php?customerid=' . $data['customerID'] . '">' . $customerName . '</td>';
                                    echo '<td>' . getAccountType($row['acctNum']) . ' *' . getFourDigits($row['acctNum']) . '</a></td>';

                                    echo '<td class = "dateCol">' .  $row['date'] . ' ' . $row['time'] . '</td>';
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
                            $result2->free();
                            
                        }

                            ?>
                            </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- ./card-body -->
        </div>
        <!-- ./card -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script>
    function Searchfunction() {
        var searchValue = $('#TransSearch').val();
        var TransRows = $('.dataRows');
        var rowsLength = TransRows.length;
        for (var i = 0; i < rowsLength; i++) {
           var singleRow = TransRows[i];
            var DateTime = singleRow.getElementsByClassName('dateCol');
            var DateTimeValue = $(DateTime).text();
            debugger;
            var splitDateTime = DateTimeValue.split(' ');
            var date = splitDateTime[0];
            if (!date.toLowerCase().startsWith(searchValue.toLowerCase())) {
                $(singleRow).hide();
            } else {
                $(singleRow).show();
            }
            
        }

    }
</script>


<?php include '../view/footer.php' ?>