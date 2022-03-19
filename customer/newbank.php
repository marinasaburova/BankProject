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
        <form action="functions/openacct.php" method="post">
            <label for="type"><b>Account Type</b></label>
            <select name="type" required>
                <option value="checking">Checking</option>
                <option value="savings">Savings</option>
            </select>

            <button type="submit" name="openacct">Create Bank Account</button>
        </form>
        <p><a href="login.php">Back to Login</a></p>

    </div>

</body>

</html>