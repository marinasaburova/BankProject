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
                        <h3 class="card-title">Close a Customer Account</h3>
                        <div class="card-tools"></div>
                    </div>
                    <div class="card-body">
                        <form action="../functions/closeacct.php" method="post">
                            <div class="form-group">
                                <label for="dateCreated">Customer</label>
                                <input type="text" name="customername" id="customername" readonly value="<?php echo $data['firstName'] . ' ' . $data['lastName']; ?>" class=" form-control" />
                            </div>

                            <div class="form-group">
                                <label for="type">Account to Close</label>
                                <select id="close" name="close" class="form-control custom-select">
                                    <?php getAccountDropdown($customer) ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="type">Transfer Funds to</label>
                                <select id="transfer" name="transfer" class="form-control custom-select">
                                    <?php getAccountDropdown($customer) ?>
                                </select>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="confirm" name="confirm" required>
                                <label class="form-check-label" for="confirm">
                                    Confirm account deletion
                                </label>
                            </div>

                            <input type="hidden" name="customer" value="<?php echo $customer ?>">

                            <div class="form-group">
                                <input type="submit" value="Delete" class="btn btn-success float-right" />
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