<?php

$db = new mysqli('localhost', 'root', 'Kittycaps0!', 'bankproject');
if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}

function disconnectDB()
{
}

function getAccountOptions($customer)
{
    global $db;
    $query = "SELECT acctNum FROM account WHERE customerID = '$customer'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['acctNum'] . '">' . $row['acctNum'] . '</option>';
    }
}

function getBalance($acctNum)
{
    global $db;
    $query = "SELECT balance FROM account WHERE acctNum = '$acctNum'";
    $result = $db->query($query);
    $num_results = $result->num_rows;

    if ($num_results == 0) {
        echo 'Uh oh... Your balance has not been found.';
    } else {
        $row = $result->fetch_assoc();
        $balance = $row['balance'];
        echo '$' . $balance;
    }
    // stuff
}

function getTransactions($acctNum)
{
    global $db;
    $query = "SELECT * FROM transaction WHERE acctNum = '$acctNum'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    if ($num_results == 0) {
        echo 'This account does not have any transactions.';
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
            echo '<td>' . $row['timeStmp'] . '</td>';
            echo "</tr>";
        }
    }
}



// Functions to include

// get 
