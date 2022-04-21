<?php
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

$customer = $_POST['customer'];
$acctNum = $_POST['close'];
$transfer = $_POST['transfer'];
include 'db.php';

closeBankAcct($acctNum, $transfer, $customer);
