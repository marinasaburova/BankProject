<?php
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

if (!isset($_POST['editTransSubmit'])) {
    header('Location: ../Pages/dashboard.php');
    exit;
}

$transactionID = filter_input(INPUT_POST, 'transactionID', FILTER_SANITIZE_NUMBER_INT);
$vendor = filter_input(INPUT_POST, 'vendor', FILTER_SANITIZE_ADD_SLASHES);
$amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_ADD_SLASHES);
$acctNum = filter_input(INPUT_POST, 'acctNum', FILTER_SANITIZE_NUMBER_INT);

include 'db.php';
editTransaction($transactionID, $amount, $type, $vendor, $acctNum);
