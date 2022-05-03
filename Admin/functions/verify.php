<?php

$uname = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_ADD_SLASHES);
$pwd = filter_input(INPUT_POST, 'pwd');

if (!isset($_GET['empSubmitLogin'])) {
    header('Location: ../Pages/dashboard.php');
    exit;
}

include 'db.php';
emplogin($uname, $pwd);
exit;
