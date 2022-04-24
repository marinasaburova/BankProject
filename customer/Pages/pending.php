<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-12">

                <!-- TABLE: LATEST TRANSACTIONS -->
                <div class="card-danger">
                    <div class="card-header border-transparent">
                        <h3 class="card-title text-white text-center">Your account is still pending approval.</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h4 class="card-title pb-2"><b>Accounts Pending</b></h4>
                        <?php
                        foreach ($pending as $p) {
                            echo                         '<p class="card-text mb-0">' .
                                getAccountType($p) . ' *' . getFourDigits($p) . '</p>';
                        }
                        ?>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <a href="users.php" class="btn btn-sm btn-info float-left">View Personal Details</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->


<!-- footer -->
<?php include '../view/footer.php'; ?>