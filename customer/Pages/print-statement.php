<?php
// Create session
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

include '../functions/db.php';

// Set commonly used variables
$customer = $_SESSION['customer'];
$accts = getAccountOptions($customer);
if (empty($accts)) {
    header('Location: new-bankacct.php');
}
if (isset($_POST['change_acct'])) {
    $acctNum = filter_input(INPUT_POST, 'change_acct', FILTER_SANITIZE_NUMBER_INT);
} else {
    $acctNum = $accts[0];
}

$month = "2022-03";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print Statement</title>

    <style>
        th,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <table>

        <?php
        $result = generateStatement($acctNum, $month);
        $num_results = $result->num_rows;
        if ($num_results == 0) {
            echo '<p class="text-center">This account does not have any transactions.</p>';
        } else {
            $i = 0;
        ?>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while (($row = $result->fetch_assoc())) {
                echo '<tr>';
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
        }
        $result->free();
            ?>
            </tbody>
    </table>
</body>

</html>