<?php
$title = "Register";
include '../view/header-simple.php';

if (isset($_GET['msg']) && $_GET['msg'] == 'error') {
    $error = 'An account with this username and/or email already exists.';
}
?>

<body class="hold-transition login-page">
    <div class="login-box" style="width:500px">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="login.html" class="h1"><b>Customer</b>Registration</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register for a new account</p>
                <?php if (isset($error)) {
                    echo '<p class="text-danger text-center">' . $error . '</p>';
                } ?>
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
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button id="register" type="submit" name="registerCustomer" class="btn btn-primary btn-block">Register</button>
                            <!--onclick="SignInFunction()"-->
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1">
                </p>
                <p class="mb-0">
                    <a href="login.php" class="text-center">Already registered? Log in.</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
    <!-- /.login-box -->
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

</body>