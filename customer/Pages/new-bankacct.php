<?php
// Create session
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Set commonly used variables
$customer = $_SESSION['customer'];
include '../functions/db.php';

$title = "Login";
include '../view/header-simple.php';
?>

<body class="hold-transition login-page">
    <div class="login-box" style="width:500px">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Account</b>Registration</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Open a New Bank Account</p>

                <form action="../functions/openacct.php" method="post">

                    <div class="form-group">
                        <label for="type">Account Type</label>
                        <select name="type" class="form-control custom-select" required>
                            <option value="checking">Checking</option>
                            <option value="savings">Savings</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-7">
                        </div>
                        <!-- /.col -->
                        <div class="col-5">
                            <button type="submit" name="openacct" class="btn btn-primary btn-block">Create Bank Account</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
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

</body>

</html>