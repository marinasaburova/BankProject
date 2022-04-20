<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$acctNum = $_POST['acctNum'];
$amount = $_POST['amount'];
$vendor = $_POST['vendor'];
include 'db.php';
withdraw($acctNum, $amount, $vendor);
