<?php
// include functions & files 
include '../functions/db.php';
include '../view/header2.php';
?>


<div class="wrapper">
  <div class="pick">
    <p>Pick your account:</p>
    <form action="dashboard.php" method="post">
      <select name="account" id="account">
        <?php
        getAccountDropdown($customer); ?>
      </select>
      <br>
      <button type="submit" name="submit">Select Account</button>
    </form>
  </div>

  <p class="centered"><a href="newbank.php">open a new bank account</a></p>
</div>

<!-- footer -->
<?php include '../view/footer.php'; ?>

</body>

</html>