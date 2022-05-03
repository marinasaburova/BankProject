<?php

session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

include 'db.php';

if (isset($_POST['approve'])) {
    $acctNum = filter_input(INPUT_POST, 'acctNum', FILTER_SANITIZE_NUMBER_INT);
    changeStatus($acctNum, 'active');
} else if (isset($_POST['deny'])) {
    $acctNum = filter_input(INPUT_POST, 'acctNum', FILTER_SANITIZE_NUMBER_INT);
    changeStatus($_POST['acctNum'], 'denied');
} else {
    header('Location: ../Pages/dashboard.php');
    die;
}
exit;
