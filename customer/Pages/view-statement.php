<?php
$month = $_GET['month'];
$title = "Statement for $month";

// include functions & files 
// hi
include 'functions/db.php';
include '../view/header.php';

$acctNum = $_SESSION['account']; ?>

<body>
    <!-- menu -->
    <?php include '../view/menu.php'; ?> <br>

    <div class="wrapper">

        <!-- loop through data to show latest transactions -->
        <h2>Transactions for <?php echo $month ?> </h2>
        <table class="trans">
            <?php
            $result = generateStatement($acctNum, $month);
            $num_results = $result->num_rows;
            if ($num_results == 0) {
                echo '<p>This account does not have any transactions.</p>';
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

    </div>

    <!-- footer -->
    <?php include '../view/footer.php'; ?>

</body>

</html>