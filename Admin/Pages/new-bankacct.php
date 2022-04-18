<?php
$title = "User Info";

// include functions & files 
include '../functions/db.php';

include '../view/header.php';
include '../view/navigation.php';

$customer = $_GET['customerid'];
$data = getCustomerData($customer);
$accts = getAccountOptions($customer);

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Form -->
        <div class="row">
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Open New Account</h3>
                        <div class="card-tools"></div>
                    </div>
                    <div class="card-body">
                        <form action="../functions/openacct.php" method="post">
                            <div class="form-group">
                                <label for="dateCreated">Customer</label>
                                <input type="text" name="customername" id="customername" readonly value="<?php echo $data['firstName'] . ' ' . $data['lastName']; ?>" class=" form-control" />
                            </div>

                            <div class="form-group">
                                <label for="type">Account Type</label>
                                <select id="type" name="type" class="form-control custom-select">
                                    <option value="checking">Checking</option>
                                    <option value="savings">Savings</option>
                                </select>
                            </div>

                            <label for="amount">Initial Deposit</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" id="deposit" name="deposit" class="form-control" min="0.01" step="0.01" aria-describedby="basic-addon3" required>
                            </div>

                            <input type="hidden" name="customer" value="<?php echo $customer ?>">

                            <div class="form-group">
                                <input type="submit" value="Register" class="btn btn-success float-right" />
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php include '../view/footer.php' ?>