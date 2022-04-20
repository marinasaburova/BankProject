<?php
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

$type = $_POST['type'];
$customer = $_POST['customer'];
$deposit = $_POST['deposit'];
include 'db.php';

createBankAcct($type, $deposit, $customer);
