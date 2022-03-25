<?php

$db = new mysqli('localhost', 'root', '', 'bankproject');
if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}

function disconnectDB()
{
}

function login($uname, $pwd)
{
    session_start();
    global $db;
    $query = "SELECT * FROM customer WHERE username = '$uname'";
    $result = $db->query($query);
    $row = $result->fetch_assoc();

    if (mysqli_num_rows($result) == 0) {
        echo '<p>Incorrect credentials.</p></br>';
        echo '<a class = "link" href=login.php>Try again.</a>';
        include('../Pages/login.php');
        exit;
    }
    if ($row['password'] !== $pwd) {
        echo '<p>Incorrect credentials.</p></br>';
        echo '<a class = "link" href=login.php>Try again.</a>';
        include('../Pages/login.php');
        $result->free();
    } else {
        $_SESSION['customer'] = $row['customerID'];
        $_SESSION['fname'] = $row['firstName'];
        $_SESSION['loggedin'] = TRUE;
        $result->free();
        header('Location: ../Pages/dashboard.php');
    }
}

// gets all info for a customer
function getCustomerData($customer)
{
    global $db;
    $query = "SELECT * FROM customer WHERE customerID = '$customer'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    if ($num_results == 0) {
        return 'Customer has not been found.';
    } elseif ($num_results != 1) {
        return 'Error.';
    } else {
        $data = $result->fetch_assoc();
        return $data;
    }
}

// gets all accounts for a customer
function getAccountDropdown($customer)
{
    global $db;
    $query = "SELECT acctNum FROM account WHERE customerID = '$customer'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['acctNum'] . '">' . getAccountType($row['acctNum']) . ' - xxxxxx' . getFourDigits($row['acctNum']) . '</option>';
    }
    $result->free();
}

function getAccountOptions($customer)
{
    global $db;
    $query = "SELECT acctNum FROM account WHERE customerID = '$customer'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    $accts = array();
    while ($row = $result->fetch_assoc()) {
        $accts[] = $row['acctNum'];
    }
    $result->free();
    return $accts;
}

// get last 4 digits of account
function getFourDigits($acctNum)
{
    $digits = substr($acctNum, -4);
    return $digits;
}

// get type of account
function getAccountType($acctNum)
{
    global $db;
    $query = "SELECT acctType FROM account WHERE acctNum = '$acctNum'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    if ($num_results != 1) {
        echo 'Error.';
    } else {
        $row = $result->fetch_assoc();
        return $row['acctType'];
    }
}

// gets balance for a specific account
function getBalance($acctNum)
{
    global $db;
    $query = "SELECT balance FROM account WHERE acctNum = '$acctNum'";
    $result = $db->query($query);
    $num_results = $result->num_rows;

    if ($num_results == 0) {
        return ' Uh oh... Your balance has not been found.';
    } else {
        $row = $result->fetch_assoc();
        $balance = $row['balance'];
        return $balance;
    }
}

// gets all transactions for an account 
function getTransactions($acctNum)
{
    global $db;
    $query = "SELECT * FROM transaction WHERE acctNum = '$acctNum'";
    $result = $db->query($query);
    return $result;
}

// generates a statement for an account for a specific month 
function generateStatement($acctNum, $month)
{
    global $db;
    $query = "SELECT * FROM transaction WHERE `date` BETWEEN '$month-01' AND '$month-31' AND `acctNum` = '$acctNum'";
    $result = $db->query($query);
    return $result;
}

// Deposit a check
function deposit($acctNum, $amount, $vendor)
{
    global $db;
    $query = "INSERT INTO `transaction`(`amount`, `type`, `vendor`, `acctNum`) VALUES ('$amount','deposit','$vendor','$acctNum')";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        $query2 = "UPDATE `account` SET `balance` = '`balance` + $amount' WHERE `account`.`acctNum` = $acctNum";
        return 'Deposit has been successfully made!';
    } else {
        return 'There was an error with your deposit';
    }
}

// Withdraw money
function withdraw($acctNum, $amount, $vendor)
{
    global $db;
    $query = "INSERT INTO `transaction`(`amount`, `type`, `vendor`, `acctNum`) VALUES ('$amount','withdraw','$vendor','$acctNum')";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        $query2 = "UPDATE `account` SET `balance` = '`balance` - $amount' WHERE `account`.`acctNum` = $acctNum";
        return 'Withdraw has been successfully made!';
    } else {
        return 'There was an error with your withdraw.';
    }
}

// Transfer money between two accounts
function transfer($from, $to, $amount)
{
    global $db;

    // Remove money from $from account
    global $db;
    $query = "INSERT INTO `transaction`(`amount`, `type`, `vendor`, `acctNum`) VALUES ('$amount','withdraw','Transfer to $to','$from')";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        $query2 = "UPDATE `account` SET `balance` = '`balance` - $amount' WHERE `account`.`acctNum` = $from";
        return 'Deposit has been successfully made!';
    } else {
        return 'There was an error with your deposit';
    }

    // Add money to $to account
    $query = "INSERT INTO `transaction`(`amount`, `type`, `vendor`, `acctNum`) VALUES ('$amount','deposit','Transfer from $from','$to')";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        $query2 = "UPDATE `account` SET `balance` = '`balance` + $amount' WHERE `account`.`acctNum` = $to";
        return 'Deposit has been successfully made!';
    } else {
        return 'There was an error with your deposit';
    }
}
