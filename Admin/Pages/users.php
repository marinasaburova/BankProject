<?php
$title = "Users";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

unset($_SESSION['viewing']);

if (isset($_GET['view'])) {
    $status = filter_input(INPUT_GET, 'view');
    if (($status != 'all') && ($status != 'active') && ($status != 'inactive')) {
        $status = 'all';
    }
} else {
    $status = 'all';
}

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="row pt-3 px-3">
                <div class="col-md-3 text-right">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Viewing <?php echo $status ?> customers
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="?view=all">All</a></li>
                            <li><a class="dropdown-item" href="?view=active">Active</a></li>
                            <li><a class="dropdown-item" href="?view=inactive">Inactive</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="search" id="UserSearch" onkeyup="Searchfunction()" class="form-control form-control-lg" placeholder="Enter Customer Name">
                        <div class="input-group-append">
                            <button type="button" onclick="Searchfunction()" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-success w-100" href="new-customer.php" role="button">Register a new customer</a>
                </div>
            </div>
            <div class="card-body pb-0">
                <div class="row d-flex align-items-stretch">
                    <?php
                    switch ($status) {
                        case ('all'):
                            $result = getAllCustomers();
                            break;
                        case ('active'):
                            $result = getAllActiveCustomers();
                            break;
                        case ('inactive'):
                            $result = getAllInactiveCustomers();
                            break;
                        default:
                            $result = getAllCustomers();
                            break;
                    }
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
                                        <ul class="ml-4 mb-0 fa-ul">
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?php echo $row['email'] ?></li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone: <?php echo $row['phone'] ?></li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $row['addr'] ?></li>
                                            <li class="small <?php if ($row['status'] == 'inactive') echo 'text-danger';
                                                                else echo 'text-success' ?>"><span class="fa-li"><i class="fas fa-exclamation-circle"></i></span> Status: <?php echo $row['status'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-left">
                                        <form action="user-details.php" method="post">
                                            <input type="hidden" name="customerid" value="<?php echo $row['customerID'] ?>">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-file"></i> View Account
                                            </button>
                                            <!--      <a href="user-details.php?customerid=<?php echo $row['customerID'] ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-file"></i> View Account
                                            </a>-->
                                        </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    function Searchfunction() {
        var searchValue = $('#UserSearch').val();
        var UserDivs = $('.UserDiv');
        var divLength = UserDivs.length;
        for (var i = 0; i < divLength; i++) {
            var UserDivi = UserDivs[i];
            var UserName = UserDivi.getElementsByClassName('UserName');
            var UserNameValue = $(UserName).text();
            if (!UserNameValue.toLowerCase().includes(searchValue.toLowerCase())) {
                $(UserDivi).hide();
            } else {
                $(UserDivi).show();
            }
        }

    }
</script>


<?php include '../view/footer.php' ?>