<?php
// include functions & files 
include 'functions/db.php';
include '../view/header.php'
?>

<body>

  <div class="wrapper">
    <div id="pick-acct">
      <p>Pick your account:</p>
      <form action="balance.php" method="post">
        <select name="account" id="account">
          <?php getAccountOptions($customer); ?>
        </select>
        <br>
        <button type="submit" name="submit">Select Account</button>
      </form>
    </div>
  </div>

  <!-- footer -->
  <?php include '../view/footer.php'; ?>

</body>

</html>