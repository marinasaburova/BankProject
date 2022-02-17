<?php
$customer = 1111111111;

// include functions & files 
include 'functions/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer Home</title>
</head>

<body>

  <p>Pick your account:</p>
  <form action="balance.php" method="post">
    <select name="account" id="account">
      <?php getAccountOptions($customer); ?>
    </select>
    <input type="submit" name="submit" />
  </form>

  <!-- footer -->
  <?php include '../view/footer.php'; ?>

</body>

</html>