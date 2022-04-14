<html>

<body>
    <?php
    session_start();
    $type = $_POST['type'];
    $customer = $_SESSION['customer'];
    $balance = 0.00;
    include 'db.php';
    global $db;

    // finds matching credentials
    $query = "INSERT INTO account (`acctType`, `balance`, `customerID`, `status`) VALUES ('$type', '$balance', '$customer', 'pending')";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        echo '<p>Your account request has been submitted. Please wait for an employee to approve it.';
        echo '<a href="../Pages/dashboard.php">Go back to dashboard</a>';
    } else {
        echo '<p>Error. Your account could not be created.</p></br>';
        echo '<a class = "link" href="../newaccount.php">Try again.</a>';
    }

    ?>
</body>

</html>