<?php
$title = "Admin Login";
include '../view/header-simple.php';
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Admin</b>Login</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="../functions/verify.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="uname" id="uname" class="form-control" placeholder="Username" maxlength="20" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-circle"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password" maxlength="60" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button id="SignIn" type="submit" class="btn btn-primary btn-block">Sign In</button>
                            <!--onclick="SignInFunction()"-->
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-0">
                    <a href="../../customer/Pages/login.php" class="text-center">Customer login</a>
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

</html>