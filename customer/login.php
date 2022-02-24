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
        <h1>Customer Login</h2>
            <form action="verify.php" method="post">
                <label for="uname">Username: </label>
                <input name="uname" type="text" size="30" required/>
                <br />
                <label for="pwd">Password:</label>
                <input name="pwd" type="password" size="30" required/><br />
                <button type="submit" name="submit">Log In</button>
            </form>
            <p><a href="../admin.html">Employee Login</a></p>

    </div>

</body>

</html>