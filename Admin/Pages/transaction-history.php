<?php
 
// create session variables
 
$title = "Statement";
 
// include functions & files
include 'db.php';
include 'header.php';
include 'navigation.php';
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