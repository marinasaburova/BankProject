<?php
// include functions & files 
include 'db.php';
include 'header.php';
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

  <p class="centered"><a href="new-bankacct.php">open a new bank account</a></p>
</div>

<!-- footer -->
<?php include 'footer.php'; ?>

</body>

</html>