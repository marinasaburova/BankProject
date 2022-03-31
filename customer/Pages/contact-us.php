<?php
$title = "Contact Us";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

?>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-body row">
      <div class="col-5 text-center d-flex align-items-center justify-content-center">
        <div class="">
          <h2>Bank<strong>Name</strong></h2>
          <p class="lead mb-5">
            CSIT 415 Semester Project<br />
            Spring 2022
          </p>
        </div>
      </div>
      <div class="col-7">
        <h4>Menna</h4>
        <h4>Kelsey Nyman</h4>
        <h4>Marina Saburova</h4>
        <p>saburovam1@montclair.edu</p>
        <h4>Saba</h4>
      </div>
    </div>
  </div>
</section>

<!-- footer -->
<?php include '../view/footer.php'; ?>