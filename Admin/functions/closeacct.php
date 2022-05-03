<?php
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

$customer = filter_input(INPUT_POST, 'customer', FILTER_SANITIZE_NUMBER_INT);
$acctNum = filter_input(INPUT_POST, 'close', FILTER_SANITIZE_NUMBER_INT);
$transfer = filter_input(INPUT_POST, 'transfer', FILTER_SANITIZE_NUMBER_INT);
include 'db.php';

closeBankAcct($acctNum, $transfer, $customer);
