<?php
$title = "Make a Transaction";

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
            <h3 class="card-title">Deposit</h3>
          </div>
          <div class="card-body">
            <form action="../functions/deposit.php" method="post">
              <div class="form-group">
                <label for="acctNum">Bank Account</label>
                <select id="acctNum" name="acctNum" class="form-control custom-select" required>
                  <option disabled selected value> -- select an account -- </option>
                  <?php getAccountDropdown($customer); ?>
                </select>
              </div>
              <label for="amount">Transaction Amount</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="number" id="amount" name="amount" class="form-control" min="0.01" step="0.01" aria-describedby="basic-addon3" required>
              </div>
              <div class="form-group">
                <label for="vendor">Vendor Name</label>
                <textarea id="vendor" name="vendor" class="form-control" rows="1" required></textarea>
              </div>
              <div class="form-group">
                <input type="reset" value="Clear" class="btn btn-secondary" />
                <input type="submit" value="Submit Transaction" class="btn btn-success float-right" />
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Withdraw</h3>
            <div class="card-tools"></div>
          </div>
          <div class="card-body">
            <form action="../functions/withdraw.php" method="post">
              <div class="form-group">
                <label for="acctNum">Bank Account</label>
                <select id="acctNum" name="acctNum" class="form-control custom-select" required>
                  <option disabled selected value> -- select an account -- </option>
                  <?php getAccountDropdown($customer); ?>
                </select>
              </div>
              <label for="amount">Transaction Amount</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="number" id="amount" name="amount" class="form-control" min="0.01" step="0.01" aria-describedby="basic-addon3" required>
              </div>
              <div class="form-group">
                <label for="vendor">Vendor Name</label>
                <textarea id="vendor" name="vendor" class="form-control" rows="1" required></textarea>
              </div>
              <div class="form-group">
                <input type="reset" value="Clear" class="btn btn-secondary" />
                <input type="submit" value="Submit Transaction" class="btn btn-success float-right" />
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
      </div>
    </div>
    <br />
  </div>
</section>
<!-- /.content -->

<?php
include '../view/footer.php';
