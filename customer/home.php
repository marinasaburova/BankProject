<?php
// include functions & files 
include 'functions/db.php';
include '../view/header.php'
?>

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