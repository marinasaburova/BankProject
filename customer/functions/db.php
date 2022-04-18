<?php

$db = new mysqli('localhost', 'root', '', 'bankproject');
if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}

function disconnectDB()
{
    global $db;
    $db->close();
}

function login($uname, $pwd)
{
    session_start();
    global $db;
    $query = "SELECT * FROM customer WHERE username = '$uname'";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $hash = $row['password'];

    if (mysqli_num_rows($result) == 0) {
        echo '<p>Incorrect credentials.</p></br>';
        echo '<a class = "link" href=login.php>Try again.</a>';
        header('Location: ../Pages/login.php');
        exit;
    }
    if (!password_verify($pwd, $hash)) {
        echo '<p>Incorrect credentials.</p></br>';
        echo '<a class = "link" href=login.php>Try again.</a>';
        header('Location: ../Pages/login.php');
        $result->free();
    } else {
        $_SESSION['customer'] = $row['customerID'];
        $_SESSION['loggedin'] = TRUE;
        $result->free();
        header('Location: ../Pages/dashboard.php');
    }
}

function register($fname, $lname, $uname, $email, $phone, $addr, $pwd, $pin)
{
    global $db;
    // finds matching credentials
    $pwdHash = password_hash($pwd, PASSWORD_BCRYPT);
    $query = "INSERT INTO customer (`firstName`, `lastName`, `username`, `email`, `phone`, `addr`, `password`, `pin`) VALUES ('$fname', '$lname', '$uname', '$email', '$phone', '$addr', '$pwdHash', $pin)";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        session_start();

        $query = "SELECT * FROM customer WHERE username = '$uname'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $_SESSION['customer'] = $row['customerID'];

        $_SESSION['loggedin'] = TRUE;
        $result->free();
        header('Location: ../Pages/new-bankacct.php');
        exit;
    } else {
        echo '<p>Error. Your account could not be created.</p></br>';
        echo '<a class = "link" href="../register.php">Try again.</a>';
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

// updates customer account info 
function updateCustomer($customer, $fname, $lname, $uname, $email, $phone, $addr)
{
    global $db;
    $query = "UPDATE `customer` SET `firstName` = '$fname', `lastName` = '$lname', `username` = '$uname', `email` = '$email', `phone` = '$phone', `addr` = '$addr' WHERE `customer`.`customerID` = '$customer'";
    echo $query;
    $result = $db->query($query);

    if (!$result) {
        echo 'Error updating info.';
    } else {
        header('Location: ../Pages/users.php');
        exit;
    }
}

// changes customer password 
function changePassword($customer, $newpwd)
{
    global $db;
    $query = "UPDATE `customer` SET `password` = '$newpwd' WHERE `customer`.`customerID` = '$customer'";
    $result = $db->query($query);
    if (!$result) {
        echo 'Error updating password.';
    } else {
        header('Location: ../Pages/users.php');
        exit;
    }
}

// gets all accounts for a customer
function getAccountDropdown($customer)
{
    global $db;
    $query = "SELECT acctNum FROM account WHERE customerID = '$customer' AND status = 'active'";
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
    $query = "SELECT acctNum FROM account WHERE customerID = '$customer' AND status = 'active'";
    $result = $db->query($query);
    $accts = array();
    while ($row = $result->fetch_assoc()) {
        $accts[] = $row['acctNum'];
    }
    $result->free();
    return $accts;
}

// gets all of the accounts waiting to be created
function getPendingAcctsCustomer($customer)
{
    global $db;
    $query = "SELECT `acctNum` FROM `account` WHERE `status`='pending' AND `customerID` = $customer ORDER BY dateCreated";
    $result = $db->query($query);
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
    $query = "SELECT * FROM transaction WHERE acctNum = '$acctNum' ORDER BY `date` DESC, `time` DESC";
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
        $query2 = "UPDATE `account` SET `balance` = `balance` + '$amount' WHERE `account`.`acctNum` = '$acctNum'";
        $result2 = $db->query($query2);
        if (!$result2) {
            echo 'Error updating your balance.';
        }
        echo 'Deposit has been successfully made!';
        header('Location: ../Pages/dashboard.php');
    } else {
        echo 'There was an error with your deposit';
        exit;
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
        $query2 = "UPDATE `account` SET `balance` = `balance` - '$amount' WHERE `account`.`acctNum` = '$acctNum'";
        $result2 = $db->query($query2);
        if (!$result2) {
            echo 'Error updating your balance.';
        }
        echo 'Withdraw has been successfully made!';
        header('Location: ../Pages/dashboard.php');
    } else {
        echo 'There was an error with your withdraw.';
        exit;
    }
}

// Transfer money between two accounts
function transfer($from, $to, $amount)
{
    global $db;

    withdraw($from, $amount, "Transfer to *" . getFourDigits($to));
    deposit($to, $amount, "Transfer from *" . getFourDigits($from));
    exit;
}
