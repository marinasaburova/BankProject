<?php
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

if (!isset($_GET['submitTransfer'])) {
    header('Location: ../Pages/dashboard.php');
    exit;
}

$from = trim(filter_input(INPUT_POST, 'acctFrom', FILTER_SANITIZE_NUMBER_INT));
$to = trim(filter_input(INPUT_POST, 'acctTo', FILTER_SANITIZE_NUMBER_INT));
$amount = trim(filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));

include 'db.php';
transfer($from, $to, $amount);

exit;
