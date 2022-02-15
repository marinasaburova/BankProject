<?php
$customer = 1111111111;
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
    <p><a href="statement.html">View History</a></p>


    <h1>Balance: $ <?php echo getBalance($customer); ?></h1>

    <!-- loop through data to create table -->
    <table>
        <h2>Recent Transactions</h2>
        <tr>
            <th>Vendor</th>
            <th>Amount</th>
        </tr>

        <tr>
            <td>SPOTIFY</td>
            <td>-$5.00</td>
        </tr>
    </table>

    <?php include '../view/footer.php'; ?>

</body>

</html>