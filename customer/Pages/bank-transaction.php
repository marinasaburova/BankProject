<?php
$title = "Make a Transaction";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Deposit</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="acctNum">Bank Account</label>
            <select id="acctNum" class="form-control custom-select">
              <?php getAccountDropdown($customer); ?>
            </select>
          </div>
          <div class="form-group">
            <label for="amount">Transaction Amount</label>
            <input type="number" id="amount" class="form-control" />
          </div>
          <div class="form-group">
            <label for="inputDescription">Transfer Description</label>
            <textarea id="inputDescription" class="form-control" rows="1"></textarea>
          </div>
          <div class="form-group">
            <p class="lead">Payment Methods:</p>
            <img src="../dist/img/credit/visa.png" alt="Visa" />
            <img src="../dist/img/credit/mastercard.png" alt="Mastercard" />
            <img src="../dist/img/credit/american-express.png" alt="American Express" />
            <img src="../dist/img/credit/paypal2.png" alt="Paypal" />
          </div>
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
          <div class="form-group">
            <label for="acctNum">Bank Account</label>
            <select id="acctNum" class="form-control custom-select">
              <?php getAccountDropdown($customer); ?>
            </select>
          </div>
          <div class="form-group">
            <label for="amount">Transaction Amount</label>
            <input type="number" id="amount" class="form-control" />
          </div>
          <div class="form-group">
            <label for="inputDescription">Transfer Description</label>
            <textarea id="inputDescription" class="form-control" rows="1"></textarea>
          </div>
          <div class="form-group">
            <p class="lead">Payment Methods:</p>
            <img src="../dist/img/credit/visa.png" alt="Visa" />
            <img src="../dist/img/credit/mastercard.png" alt="Mastercard" />
            <img src="../dist/img/credit/american-express.png" alt="American Express" />
            <img src="../dist/img/credit/paypal2.png" alt="Paypal" />
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-secondary">Cancel</a>
      <input type="submit" value="Submit Transaction" class="btn btn-success float-right" />
    </div>
  </div>
  <br />
</section>
<!-- /.content -->