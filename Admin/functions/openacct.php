<?php
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

if (!isset($_GET['openBankAcct'])) {
    header('Location: ../Pages/dashboard.php');
    exit;
}

$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_ADD_SLASHES);
$customer = filter_input(INPUT_POST, 'customer', FILTER_SANITIZE_NUMBER_INT);
$deposit = filter_input(INPUT_POST, 'deposit', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

include 'db.php';

createBankAcct($type, $deposit, $customer);
exit;
