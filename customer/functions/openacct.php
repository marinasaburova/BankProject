<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_POST['openacct'])) {
    header('Location: ../Pages/new-bankacct.php');
    exit;
}

$type = trim(filter_input(INPUT_POST, 'type', FILTER_SANITIZE_ADD_SLASHES));
$customer = $_SESSION['customer'];

include 'db.php';
requestBankAcct($type, $customer);
exit;
