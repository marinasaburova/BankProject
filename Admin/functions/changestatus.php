<?php

session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

include 'db.php';

if (isset($_POST['approve'])) {
    $acctNum = $_POST['acctNum'];
    changeStatus($acctNum, 'active');
} else if (isset($_POST['deny'])) {
    $acctNum = $_POST['acctNum'];
    changeStatus($_POST['acctNum'], 'denied');
} else {
    header('Location: ../Pages/dashboard.php');
    die;
}
