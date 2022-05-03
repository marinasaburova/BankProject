<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}


$acctNum = filter_input(INPUT_POST, 'acctNum', FILTER_SANITIZE_NUMBER_INT);
$amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$vendor = filter_input(INPUT_POST, 'vendor', FILTER_SANITIZE_ADD_SLASHES);

include 'db.php';
deposit($acctNum, $amount, $vendor);
