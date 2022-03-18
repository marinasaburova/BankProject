<?php
// include functions & files 
include 'functions/db.php';
include '../view/header.php'
?>

<body>

  <div class="wrapper">
    <div class="pick">
      <p>Pick your account:</p>
      <form action="balance.php" method="get">
        <select name="account" id="account">
          <?php getAccountOptions($customer); ?>
        </select>
        <br>
        <button type="submit" name="submit">Select Account</button>
      </form>
    </div>

    <p class="centered"><a href="newaccount.php">open a new bank account</a></p>
  </div>

  <!-- footer -->
  <?php include '../view/footer.php'; ?>

</body>

</html>