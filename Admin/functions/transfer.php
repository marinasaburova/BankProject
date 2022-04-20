<?php
session_start(); 

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

$from = $_POST['acctFrom'];
$to = $_POST['acctTo'];
$amount = $_POST['amount'];
include 'db.php';
transfer($from, $to, $amount);
