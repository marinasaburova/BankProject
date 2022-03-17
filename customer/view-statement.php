<?php
$month = $_GET['month'];
$title = "Statement for $month";

// include functions & files 
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
            <?php generateStatement($acctNum, $month); ?>
        </table>

    </div>

    <!-- footer -->
    <?php include '../view/footer.php'; ?>

</body>

</html>