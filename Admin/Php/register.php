<html>

<body>
    <?php
    
    include 'db.php';
    $conn = OpenCon();
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $addr = $_POST['addr'];
    $pwd = $_POST['pwd'];
    $pwd2 = $_POST['pwd2'];
    $pin = '1234';

    if ($pwd !== $pwd) {
        echo 'Error: your passwords need to match.';
        echo '<a class = "link" href=register.php>Try again.</a>';
        exit;
    }

    // finds matching credentials
    $query = "INSERT INTO customer (firstName, lastName, username, email, phone, addr, password, pin) VALUES ('$fname', '$lname', '$uname', '$email', '$phone', '$addr', '$pwd', $pin)";
    //$result = $db->query($query);
    // checks for successful result

    
    if (mysqli_query($conn, $query)) {
        $_SESSION['customer'] = $row['customerID'];
        $_SESSION['loggedin'] = TRUE;
        header('Location: new-bankacct.php');
        exit;
    } else {
     
        echo '<p>Error. Your account could not be created.</p></br>';
        echo '<a class = "link" href="register.php">Try again.</a>';
    }

    // disconnect from database
    CloseCon($conn);
    ?>
</body>

</html>