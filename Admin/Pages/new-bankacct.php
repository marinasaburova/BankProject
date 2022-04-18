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
                            <label for="type">Account Type</label>

                            <div class="input-group mb-3">
                                <select name="type" class="form-select form-select-lg mb-3" required>
                                    <option value="checking">Checking</option>
                                    <option value="savings">Savings</option>
                                </select>
                            </div>
                            <input type="hidden" name="customer" value="'<?php $customer ?>'">

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