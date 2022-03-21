<?php

$title = "Balance";

// include functions & files 
include 'functions/db.php';
include '../view/header.php';

$acctNum = $_GET['account'];
$_SESSION['account'] = $acctNum;
?>

<body>
    <!-- menu -->
    <?php include '../view/menu.php'; ?> <br>

    <div class="wrapper">

        <!-- display balance -->
        <h1>Balance:
            <?php
            $result = getBalance($acctNum);
            $num_results = $result->num_rows;

            if ($num_results == 0) {
                echo '<p>Uh oh... Your balance has not been found.</p>';
            } else {
                $row = $result->fetch_assoc();
                $balance = $row['balance'];
                echo '$' . $balance;
            }
            $result->free(); ?>
        </h1>

        <!-- loop through data to show latest transactions -->
        <h2>Recent Transactions: </h2>
        <table class="trans">
            <?php
            $result = getTransactions($acctNum);
            $num_results = $result->num_rows;
            if ($num_results == 0) {
                echo '<p class="centered">This account does not have any transactions.</p>';
            } else {
                echo '<tr><th>Vendor</th> <th>Amount</th> <th>Time Stamp</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo '<td>' . $row['vendor'] . '</td>';
                    if ($row['type'] == 'withdraw') {
                        echo '<td> -$' . $row['amount'] . '</td>';
                    }
                    if ($row['type'] == 'deposit') {
                        echo '<td> +$' . $row['amount'] . '</td>';
                    }
                    echo '<td>' . $row['date'] . ' ' . $row['time'] . '</td>';
                    echo "</tr>";
                }
            }
            $result->free();
            ?>
        </table>

        <!-- option to view history -->
        <p class="centered"><a href="statement.php">View History</a></p>
    </div>

    <!-- footer -->
    <?php include '../view/footer.php'; ?>

</body>

</html>