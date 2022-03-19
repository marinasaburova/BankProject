<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>" />

    <title>Customer Login</title>
</head>

<body>
    <div class="login">
        <form action="functions/register.php" method="post">
            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname" required />

            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname" required />

            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required />

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required />

            <label for="pwd"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pwd" required />

            <label for="pwd2"><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm Password" name="pwd2" required />

            <button type="submit" name="register">Create Account</button>
        </form>
        <p><a href="login.php">Back to Login</a></p>

    </div>

</body>

</html>