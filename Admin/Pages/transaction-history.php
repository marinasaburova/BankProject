<?php

// create session variables

$title = "Statement";

// include functions & files
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';
?>

<div class="pick">
  <p>Select the month</p>
  <form action="view-statement.php" target="_blank" method="get">
    <input type="month" name="month" id="month" />
    <br>
    <button type="submit" name="submit">Generate Statement</button>
  </form>
</div>


<!-- footer -->
<?php include 'footer.php'; ?>