<?php
// create session variables

$title = "Statement";

// include functions & files 
include 'functions/db.php';
include '../view/header.php'; ?>

<body>
  <!-- menu -->
  <?php include '../view/menu.php'; ?> <br>

  <div class="wrapper">

    <!-- display statements -->
    <h1>Statements</h1>

    <div class="pick">
      <p>Select the month</p>
      <form action="view-statement.php" target="_blank" method="get">
        <input type="month" name="month" id="month" />
        <br>
        <button type="submit" name="submit">Generate Statement</button>
      </form>
    </div>
  </div>

  <!-- footer -->
  <?php include '../view/footer.php'; ?>

</body>

</html>