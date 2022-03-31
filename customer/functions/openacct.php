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
    $query = "INSERT INTO account (`acctType`, `balance`, `customerID`) VALUES ('$type', '$balance', '$customer')";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        header('Location: ../Pages/dashboard.php');
    } else {
        echo '<p>Error. Your account could not be created.</p></br>';
        echo '<a class = "link" href="../newaccount.php">Try again.</a>';
    }

    ?>
</body>

</html>