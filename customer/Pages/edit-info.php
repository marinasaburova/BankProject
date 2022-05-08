<?php
$title = "Edit Account";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

$data = getCustomerData($customer);

if addslashes(isset($_GET['msg'])) {
    if ($_GET['msg'] == 'pwdError') {
        $pwdError = 'Wrong current password.';
    }
}

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Personal Info</h3>
                    </div>
                    <div class="card-body">
                        <form action="../functions/update-customer.php" method="post">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" value="<?php echo $data['firstName']; ?>" class="form-control" maxlength="30" readonly />
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" id="lname" value="<?php echo $data['lastName']; ?>" class=" form-control" maxlength="30" readonly />
                            </div>
                            <div class="form-group">
                                <label for="uname">Username</label>
                                <input type="text" name="uname" id="uname" value="<?php echo $data['username']; ?>" class=" form-control" maxlength="20" readonly />
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" value="<?php echo $data['email']; ?>" class=" form-control" maxlength="60" required />
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" value="<?php echo $data['phone']; ?>" class="form-control" minlength="10" maxlength="10" required />
                            </div>
                            <div class="form-group">
                                <label for="addr">Home Address</label>
                                <input type="text" name="addr" id="addr" value="<?php echo $data['addr']; ?>" class=" form-control" maxlength="60" required />
                            </div>
                            <div class="form-group">
                                <label for="dateCreated">Member Since</label>
                                <input type="text" name="dateCreated" id="dateCreated" readonly value="<?php echo $data['dateCreated']; ?>" class=" form-control" />
                            </div>
                            <div class="form-group">
                                <small class="text-muted">To change the more sensitive data, please see a teller.</small>
                            </div>
                            <div class="form-group">
                                <input type="reset" value="Reset" class="btn btn-secondary" />
                                <input type="submit" name="updateInfo" value="Update" class="btn btn-success float-right" />
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
                        <h3 class="card-title">Change Password</h3>

                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (isset($pwdError)) {
                            echo "<p class='text-danger'>$pwdError</p>";
                        } ?>
                        <form action="../functions/update-customer.php" method="post" oninput='newPwd2.setCustomValidity(newPwd2.value != newPwd.value ? "Passwords do not match." : "")'>
                            <div class="form-group">
                                <label for="currPwd">Current Password</label>
                                <input type="password" name="currPwd" id="currPwd" placeholder="Enter current password" class="form-control" maxlength="60" required />
                            </div>
                            <div class="form-group">
                                <label for="newPwd">New Password</label>
                                <input type="password" name="newPwd" id="newPwd" class="form-control" maxlength="60" required />
                            </div>
                            <div class="form-group">
                                <label for="newPwd2">Confirm New Password</label>
                                <input type="password" name="newPwd2" id="newPwd2" class="form-control" maxlength="60" required />
                            </div>
                            <div class="form-group">
                                <input type="reset" value="Reset" class="btn btn-secondary" />
                                <input type="submit" name="updatePWD" value="Update" class="btn btn-success float-right" />
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    </div>
    <br />
</section>
<!-- /.content -->

<?php
include '../view/footer.php';
