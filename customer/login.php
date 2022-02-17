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
            <form action="home.php" method="post">
                Username:<br />
                <input name="uname" type="text" size="30" />
                <br />
                Password:<br />
                <input name="passw" type="password" size="30" /><br />
                <input type="submit" name="submit" value="Log In" />
            </form>
            <p><a href="../admin.html">Employee Login</a></p>

    </div>

</body>

</html>