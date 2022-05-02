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

$transactionID = filter_input(INPUT_POST, 'transactionID');
$vendor = filter_input(INPUT_POST, 'vendor');
$amount = filter_input(INPUT_POST, 'amount');
$type = filter_input(INPUT_POST, 'type');
$acctNum = filter_input(INPUT_POST, 'acctNum');

include 'db.php';
editTransaction($transactionID, $amount, $type, $vendor, $acctNum);
