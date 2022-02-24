<?php
// create session variables
$acctNum = $_POST['account'];

$title = "Balance";

// include functions & files 
include 'functions/db.php';
include '../view/header.php'; ?>

<body>
    <!-- menu -->
    <?php include '../view/menu.php'; ?> <br>

    <div class="wrapper">
        <!-- option to view history -->
        <p><a href="statement.html">View History</a></p>

        <!-- display balance -->
        <h1>Balance: <?php getBalance($acctNum); ?></h1>

        <!-- loop through data to show latest transactions -->
        <h2>Recent Transactions: </h2>
        <table class="trans">
            <?php getTransactions($acctNum); ?>
        </table>
    </div>

    <!-- footer -->
    <?php include '../view/footer.php'; ?>

</body>

</html>