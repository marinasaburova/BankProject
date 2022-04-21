<?php
$title = "Transfer Funds";

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
                        <h3 class="card-title">Transfer</h3>
                    </div>
                    <div class="card-body">
                        <form action="../functions/transfer.php" method="post">
                            <div class="form-group">
                                <label for="acctFrom">From Account</label>
                                <select id="acctFrom" name="acctFrom" class="form-control custom-select" required>
                                    <option disabled selected value> -- select an account -- </option>
                                    <?php getAccountDropdown($customer); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="acctTo">To Account</label>
                                <select id="acctTo" name="acctTo" class="form-control custom-select" required>
                                    <option disabled selected value> -- select an account -- </option>
                                    <?php getAccountDropdown($customer); ?>
                                </select>
                            </div>
                            <label for="amount">Transfer Amount</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" id="amount" name="amount" class="form-control" min="0.01" step="0.01" max="10000" aria-describedby="basic-addon3" required>
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
    </div>
    <br />
</section>
<!-- /.content -->

<?php
include '../view/footer.php';
