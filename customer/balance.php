<?php
// create session variables
$customer = 1111111111;
$acctNum = $_POST['account'];

// include functions & files 
include 'functions/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Balance</title>
</head>

<body>
    <!-- menu -->
    <?php include '../view/menu.php'; ?>

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