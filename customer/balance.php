<?php
// create session variables
$customer = 1111111111;
$acctNum = $_POST['account'];

$title = "Balance";

// include functions & files 
include 'functions/db.php';
include '../view/header.php'; ?>

<body>
    <!-- menu -->
    <?php include '../view/menu.php'; ?> <br>

    <!-- option to view history -->
    <p><a href="statement.html">View History</a></p>

    <!-- display balance -->
    <h1>Balance: <?php getBalance($acctNum); ?></h1>

    <!-- loop through data to show latest transactions -->
    <h2>Recent Transactions: </h2>
    <table>
        <?php getTransactions($acctNum); ?>
    </table>

    <!-- footer -->
    <?php include '../view/footer.php'; ?>

</body>

</html>