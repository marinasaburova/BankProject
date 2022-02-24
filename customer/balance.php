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

        <!-- display balance -->
        <h1>Balance: <?php getBalance($acctNum); ?></h1>

        <!-- loop through data to show latest transactions -->
        <h2>Recent Transactions: </h2>
        <table class="trans">
            <?php getTransactions($acctNum); ?>
        </table>

        <!-- option to view history -->
        <p class="centered"><a href="statement.html">View History</a></p>
    </div>

    <!-- footer -->
    <?php include '../view/footer.php'; ?>

</body>

</html>