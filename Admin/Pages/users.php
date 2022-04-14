<?php
$title = "Users";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Default box -->
        <div class="card card-solid">
            <br />
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <input type="search" id="UserSearch" onkeyup="Searchfunction()" class="form-control form-control-lg" placeholder="Enter Customer Name">
                        <div class="input-group-append">
                            <button type="button" onclick="Searchfunction()" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pb-0">
                <div class="row d-flex align-items-stretch">
                    <?php
                    $result = getAllCustomers();
                    $num_results = $result->num_rows;

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <!-- Customer -->
                        <div class="col-12 col-sm-6 col-md-3 flex-fill UserDiv">
                            <div class="card bg-light" style="height:250px">
                                <div class="card-body pt-3">
                                    <div class="card-title">
                                        <h2 class="lead"><b class="UserName"><?php echo $row['lastName'] . ', ' . $row['firstName'] ?></b></h2>
                                    </div>
                                    <div class="card-text">
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?php echo $row['email'] ?></li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone: <?php echo $row['phone'] ?></li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $row['addr'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-left">
                                        <a href="user-details.php?customerid=<?php echo $row['customerID'] ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-file"></i> View Account
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- ./customer -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script>
    function Searchfunction() {
        var searchValue = $('#UserSearch').val();
        var UserDivs = $('.UserDiv');
        var divLength = UserDivs.length;
        for (var i = 0; i < divLength; i++) {
            var UserDivi = UserDivs[i];
            var UserName = UserDivi.getElementsByClassName('UserName');
            var UserNameValue = $(UserName).text();
            if (!UserNameValue.toLowerCase().startsWith(searchValue.toLowerCase())) {
                $(UserDivi).hide();
            } else {
                $(UserDivi).show();
            }
        }

    }
</script>


<?php include '../view/footer.php' ?>