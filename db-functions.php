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

// Employee login
function emplogin($uname, $pwd)
{
    global $db;
    $query = "SELECT * FROM employee WHERE username = '$uname'";
    $result = $db->query($query);
    $row = $result->fetch_assoc();

    if (mysqli_num_rows($result) == 0) {
        echo '<p>Incorrect credentials.</p></br>';
        header('Location: ../Pages/login.html');
        exit;
    }
    if ($row['password'] !== $pwd) {
        echo '<p>Incorrect credentials.</p></br>';
        header('Location: ../Pages/login.html');
        $result->free();
        exit;
    } else {
        session_start();
        $_SESSION['employee'] = $row['employeeID'];
        $_SESSION['emploggedin'] = TRUE;
        $result->free();
        header('Location: ../Pages/dashboard.php');
        exit;
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

function requestBankAcct($type, $customer)
{
    global $db;

    $query = "INSERT INTO account (`acctType`, `balance`, `customerID`, `status`) VALUES ('$type', '0.00', '$customer', 'pending')";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        echo '<p>Your account request has been submitted. Please wait for an employee to approve it.';
        echo '<a href="../Pages/dashboard.php">Go back to dashboard</a>';
    } else {
        echo '<p>Error. Your account could not be created.</p></br>';
        echo '<a class = "link" href="../newaccount.php">Try again.</a>';
    }
}

// create a new bank account for a customer
function createBankAcct($type, $deposit, $customer)
{
    global $db;

    $query = "INSERT INTO account (`acctType`, `balance`, `customerID`, `status`) VALUES ('$type', $deposit, '$customer', 'active')";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        header("Location: ../Pages/user-details.php?customerid=$customer");
    } else {
        echo '<p>Error. Your account could not be created.</p></br>';
        echo '<a class = "link" href="new-bankacct.php">Try again.</a>';
    }
}

// closes a bank account for a customer
function closeBankAcct($acctNum, $transfer)
{
    global $db;

    $query = "UPDATE `account` SET `status` = 'closed' WHERE `account`.`acctNum` = '$acctNum'";
    echo $query;
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        $balance = getBalance($acctNum);
        transfer($acctNum, $transfer, $balance);
        // header("Location: ../Pages/user-details.php?customerid=$customer");
    } else {
        echo '<p>Error. Your account could not be updated.</p></br>';
        echo '<a class = "link" href="new-bankacct.php">Try again.</a>';
    }
}

// changes customer password 
function changePassword($customer, $newpwd)
{
    global $db;

    $pwdHash = password_hash($newpwd, PASSWORD_BCRYPT);

    $query = "UPDATE `customer` SET `password` = '$pwdHash' WHERE `customer`.`customerID` = '$customer'";
    $result = $db->query($query);
    if (!$result) {
        echo 'Error updating password.';
    } else {
        if (isset($_SESSION['loggedin'])) {
            echo 'customer';
            header('Location: ../Pages/users.php');
            exit;
        }
        if (isset($_SESSION['emploggedin'])) {
            echo 'employee';
            header("Location: ../Pages/user-details.php?customerid=$customer");
            exit;
        }
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
        if (isset($_SESSION['loggedin'])) {
            header('Location: ../Pages/users.php');
            exit;
        }
        if (isset($_SESSION['emploggedin'])) {
            header("Location: ../Pages/users-details.php?customerid=$customer");
            exit;
        }
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

// Get customer ID for an account number
function getCustomerUsingAcct($acctNum)
{
    global $db;
    $query = "SELECT customerID FROM account WHERE acctNum = '$acctNum'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    if ($num_results != 1) {
        echo 'Error.';
    } else {
        $row = $result->fetch_assoc();
        return $row['customerID'];
    }
}

// returns a list of all customers
function getAllCustomers()
{
    global $db;
    $query = "SELECT * FROM `customer` WHERE `status` = 'active' ORDER BY `lastName` ASC";
    $result = $db->query($query);
    return $result;
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

// gets all of the accounts waiting to be created
function getPendingAccts()
{
    global $db;
    $query = "SELECT * FROM `account` WHERE `status`='pending' ORDER BY dateCreated";
    $result = $db->query($query);
    return $result;
}

// gets all of the accounts waiting to be created for a specific customer
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

// gets all transactions for a single account 
function getTransactions($acctNum)
{
    global $db;
    $query = "SELECT * FROM transaction WHERE acctNum = '$acctNum' ORDER BY `date` DESC, `time` DESC";
    $result = $db->query($query);
    return $result;
}

// get all transactions for a specific customer
function getCustomerTransactions($customer)
{
    global $db;
    $query = "SELECT * FROM `transaction` INNER JOIN `account` ON `account`.`acctNum` = `transaction`.`acctNum` WHERE `customerID` = $customer ORDER BY `date` DESC, `time` DESC";
    $result = $db->query($query);
    return $result;
}

// get all transactions amongst all customers
function getAllTransactions()
{
    global $db;
    $query = "SELECT * FROM `transaction` ORDER BY `date` DESC, `time` DESC";
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
    withdraw($from, $amount, "Transfer to *" . getFourDigits($to));
    deposit($to, $amount, "Transfer from *" . getFourDigits($from));
    exit;
}

// gets all info for a customer
function getEmployeeData($customer)
{
    global $db;
    $query = "SELECT * FROM employee WHERE employeeID = '$customer'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    if ($num_results == 0) {
        return 'Employee has not been found.';
    } elseif ($num_results != 1) {
        return 'Error.';
    } else {
        $data = $result->fetch_assoc();
        return $data;
    }
}

// change status of a bank account
function changeStatus($acctNum, $status)
{
    global $db;
    $query = "UPDATE `account` SET `status` = '$status' WHERE `account`.`acctNum` = '$acctNum'";
    $result = $db->query($query);

    if (!$result) {
        echo 'Error updating account status.';
    } else {
        header('Location: ../Pages/dashboard.php');
        exit;
    }
}

// Get number of customers
function getCustomerCount()
{
    global $db;
    $query = "SELECT * FROM customer";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    return $num_results;
}

// Get number of bank accounts
function getBankAcctCount()
{
    global $db;
    $query = "SELECT * FROM account";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    return $num_results;
}
