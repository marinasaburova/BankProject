<?php
$title = "Register";

include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

unset($_SESSION['viewing']);

?>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <!-- /.login-logo -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Register a new customer</h3>
                    </div>
                    <div class="card-body">

                        <form action="../functions/register.php" method="post" oninput='pwd2.setCustomValidity(pwd2.value != pwd.value ? "Passwords do not match." : "")'>

                            <label for="fname">First Name</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter First Name" name="fname" maxlength="30" required />
                            </div>

                            <label for="lname">Last Name</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter Last Name" name="lname" maxlength="30" required />
                            </div>

                            <label for="uname">Username</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter Username" name="uname" maxlength="20" required />
                            </div>

                            <label for="email">Email</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="email" placeholder="Enter Email" name="email" maxlength="60" required />
                            </div>

                            <label for="phone">Phone</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="tel" placeholder="Enter Phone" name="phone" pattern="[0-9]{10}" minlength="10" maxlength="10" required />
                            </div>

                            <label for="addr">Address</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter Home Address" name="addr" maxlength="60" required />
                            </div>

                            <label for="pwd">Password</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="password" placeholder="Enter Password" name="pwd" maxlength="60" required />
                            </div>

                            <label for="pwd2">Confirm Password</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="password" placeholder="Confirm Password" name="pwd2" maxlength="60" required />
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <button id="clear" type="clear" class="btn btn-secondary btn-block">Clear</button>
                                </div>
                                <div class="col-4"></div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button id="register" type="submit" class="btn btn-primary btn-block">Register</button>
                                    <!--onclick="SignInFunction()"-->
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <p class="mb-1">
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row --.>
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="../dist/js/pages/login.js"></script>
<script>
    function SignInFunction() {
        var _signInID = document.getElementById('email').value;
        var _pass = document.getElementById('password').value;

        if (_signInID === 'syeds3@montclair.edu' && _pass === 'password') {
            window.location = 'users.html';
        } else {
            alert('Please provide the correct credentials.');
        }
    }
</script>
<?php
include '../view/footer.php';
?>
</body>