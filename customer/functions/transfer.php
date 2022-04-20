<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$from = $_POST['acctFrom'];
$to = $_POST['acctTo'];
$amount = $_POST['amount'];
include 'db.php';
transfer($from, $to, $amount);
