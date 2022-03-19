<html>

<body>
    <?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwd2 = $_POST['pwd2'];
    $pin = '1234';
    include 'db.php';

    if ($pwd !== $pwd) {
        echo 'Error: your passwords need to match.';
        echo '<a class = "link" href=/../newaccount.php>Try again.</a>';
        exit;
    }

    global $db;

    // finds matching credentials
    $query = "INSERT INTO customer (`firstName`, `lastName`, `username`, `email`, `password`, `pin`) VALUES ('$fname', '$lname', '$uname', '$email', '$pwd', $pin)";
    $result = $db->query($query);

    // checks for successful result
    if ($result) {
        echo '<p>Account successfully created!</p></br>';
        login($uname, $pwd);
        echo '<a class = "link" href="../home.php">Please enter.</a>';
    } else {
        echo '<p>Error. Your account could not be created.</p></br>';
        echo '<a class = "link" href="../newaccount.php">Try again.</a>';
    }

    // disconnect from database
    $result->free();

    ?>
</body>

</html>