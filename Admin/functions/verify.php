<?php
if (!isset($_POST['empSubmitLogin'])) {
    header('Location: ../Pages/dashboard.php');
    exit;
}

$uname = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_ADD_SLASHES);
$pwd = filter_input(INPUT_POST, 'pwd');

include 'db.php';
emplogin($uname, $pwd);
exit;
