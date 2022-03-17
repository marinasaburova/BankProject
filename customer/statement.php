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

    <form action="view-statement.php" method="get">
      <label for="month">Month:</label>
      <input type="month" name="month" id="month" />
      <input type="submit" name="submit" id="submit" />
    </form>

  </div>

  <!-- footer -->
  <?php include '../view/footer.php'; ?>

</body>

</html>