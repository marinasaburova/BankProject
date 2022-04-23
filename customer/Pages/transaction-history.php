<?php

// create session variables

$title = "Statement";

// include functions & files
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Select Month</h3>
          </div>
          <div class="card-body">
            <div class="pick">
              <form action="statement.php" method="get">
                <div class="form-group">
                  <input type="month" name="month" id="month" class="form-control custom-select" required />
                </div>
                <div class="form-group">
                  <select id="acctNum" name="acctNum" class="form-control custom-select" required>
                    <?php
                    $accts = getAccountOptions($customer);
                    foreach ($accts as $acctNum)
                      echo '<option value="' . $acctNum . '">' . getAccountType($acctNum) . ' - *' . getFourDigits($acctNum) . ' (' . getAccountStatus($acctNum) .  ')</option>';

                    ?> </select>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-success">Generate Statement</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
  <br />
</section>
<!-- /.content -->

<!-- footer -->
<?php include '../view/footer.php'; ?>