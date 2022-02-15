<?php

$db = new mysqli('localhost', 'root', 'Kittycaps0!', 'bankproject');
if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}

function disconnectDB()
{
}

function getBalance($customer)
{
    global $db;
    $query = "SELECT balance FROM account WHERE customerID = '$customer'";
    $result = $db->query($query);
    $num_results = $result->num_rows;

    if ($num_results == 0) {
        echo '<p>Uh oh... Your balance has not been found.</p><br>';
    } else {
        $row = $result->fetch_assoc();
        $balance = $row['balance'];
        return $balance;
    }
    // stuff
}


// Functions to include

// get balance
// get 
