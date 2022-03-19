<html>

<body>
    <?php
    $type = $_POST['type'];
    $balance = 0.00;
    include '../../view/header.php';
    include 'db.php';
    global $db;

    // finds matching credentials
    $query = "INSERT INTO account (`acctType`, `balance`, `customerID`) VALUES ('$type', '$balance', '$customer')";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        $result->free();
        echo '<p>Bank account successfully created!</p></br>';
        echo '<a class = "link" href="../home.php">Please enter.</a>';
    } else {
        echo '<p>Error. Your account could not be created.</p></br>';
        echo '<a class = "link" href="../newaccount.php">Try again.</a>';
    }

    ?>
</body>

</html>