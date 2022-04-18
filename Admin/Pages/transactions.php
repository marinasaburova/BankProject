<?php
$title = "All Transactions";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

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
                <div class="table-responsive">
                    <table class="table m-0 table-hover">

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
                            while (($row = $result->fetch_assoc())) {
                                $cid = getCustomerUsingAcct($row['acctNum']);
                                $data = getCustomerData($cid);
                                $customerName = $data['firstName'] . ' ' . $data['lastName'];

                                echo '<tr>';
                                echo '<td><a href="statement.php?customerid=' . $data['customerID'] . '">' . $customerName . '</td>';
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
            <!-- ./card-body -->
</section>
<!-- /.content -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script>
    function Searchfunction() {
        var searchValue = $('#UserSearch').val();
        var UserDivs = $('.UserDiv');
        var divLength = UserDivs.length;
        for (var i = 0; i < divLength; i++) {
            var UserDivi = UserDivs[i];
            var UserName = UserDivi.getElementsByClassName('UserName');
            var UserNameValue = $(UserName).text();
            if (!UserNameValue.toLowerCase().startsWith(searchValue.toLowerCase())) {
                $(UserDivi).hide();
            } else {
                $(UserDivi).show();
            }
        }

    }
</script>


<?php include '../view/footer.php' ?>