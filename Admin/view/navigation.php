<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../Pages/dashboard.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../Pages/contact-us.php" class="nav-link">Contact</a>
            </li>
        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../Pages/dashboard.php" class="brand-link">
            <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Bank Name</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <!-- <img src="../dist/img/Saba.jpg" class="img-circle elevation-2" alt="User Image">-->
                </div>
                <div class="info">
                    <a href="../Pages/dashboard.php" class="d-block ">
                        <?php $data = getEmployeeData($employee);
                        echo $data['firstName'] . ' ' . $data['lastName'] ?>
                    </a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library -->

                    <?php
                    $current = basename($_SERVER['PHP_SELF']);
                    $dashboard_class = "nav-link";
                    $users_class = "nav-link";
                    $transaction_class = "nav-link";
                    $transaction_nav = 'nav-item';
                    $bank_trans_class = "nav-link";
                    $trans_history_class = 'nav-link';
                    $bank_transfer_class = 'nav-link';

                    if ($current == 'dashboard.php') {
                        $dashboard_class = 'nav-link active';
                    }
                    if ($current == 'users.php') {
                        $users_class = 'nav-link active';
                    }
                    if ($current == 'transactions.php') {
                        $transaction_class = 'nav-link active';
                    }
                    if ($current == 'bank-transaction.php') {
                        $bank_trans_class = 'nav-link active';
                        $transaction_nav = 'nav-item menu-open';
                    }
                    if ($current == 'transaction-history.php') {
                        $trans_history_class = 'nav-link active';
                        $transaction_nav = 'nav-item menu-open';
                    }
                    if ($current == 'statement.php') {
                        $trans_history_class = 'nav-link active';
                        $transaction_nav = 'nav-item menu-open';
                    }
                    if ($current == 'make-transfer.php') {
                        $bank_transfer_class = 'nav-link active';
                        $transaction_nav = 'nav-item menu-open';
                    }
                    ?>

                    <li class="nav-item">
                        <a href="../Pages/dashboard.php" class="<?php echo $dashboard_class ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../Pages/users.php" class="<?php echo $users_class ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User Info
                            </p>
                        </a>
                    </li>
                    <li class="<?php echo $transaction_nav ?>">
                        <a href="#" class="<?php echo $transaction_class ?>">
                            <i class="nav-icon fas fa-regular fa-file-invoice-dollar"></i>
                            <p>
                                Transaction
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="bank-transaction.php" class="<?php echo $bank_trans_class ?>">
                                    <i class="nav-icon fas fa-regular fa-hand-holding-usd"></i>
                                    <p>
                                        Make A Transaction
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="make-transfer.php" class="<?php echo $bank_transfer_class ?>">
                                    <i class="nav-icon fas fa-regular fa-exchange-alt"></i>
                                    <p>
                                        Transfer Funds
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="transaction-history.php" class="<?php echo $trans_history_class ?>">
                                    <i class="nav-icon fas fa-solid fa-file-invoice"></i>
                                    <p>
                                        Transaction History
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="../functions/logout.php" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?php echo $title ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><?php echo $title ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->