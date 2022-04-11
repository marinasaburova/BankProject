<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Customer Registration</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="width:500px">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="login.html" class="h1"><b>Customer</b>Registration</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register for a new account</p>

                <form action="register.php" method="post">

                    <label for="fname">First Name</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" placeholder="Enter First Name" name="fname" required />
                    </div>

                    <label for="lname">Last Name</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" placeholder="Enter Last Name" name="lname" required />
                    </div>

                    <label for="uname">Username</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" placeholder="Enter Username" name="uname" required />
                    </div>

                    <label for="email">Email</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="email" placeholder="Enter Email" name="email" required />
                    </div>

                    <label for="phone">Phone</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="phone" placeholder="Enter Phone" name="phone" required />
                    </div>

                    <label for="addr">Address</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" placeholder="Enter Home Address" name="addr" required />
                    </div>

                    <label for="pwd">Password</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="password" placeholder="Enter Password" name="pwd" required />
                    </div>

                    <label for="pwd2">Confirm Password</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="password" placeholder="Confirm Password" name="pwd2" required />
                    </div>

                    <div class="row">
                        <div class="col-8">
                        </div>
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
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <script src="../../dist/js/pages/login.js"></script>

</body>