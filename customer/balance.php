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
        <h1>Balance: <?php getBalance($acctNum); ?></h1>

        <!-- loop through data to show latest transactions -->
        <h2>Recent Transactions: </h2>
        <table class="trans">
            <?php getTransactions($acctNum); ?>
        </table>

        <!-- option to view history -->
        <p class="centered"><a href="statement.php">View History</a></p>
    </div>

    <!-- footer -->
    <?php include '../view/footer.php'; ?>

</body>

</html>