<?php
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

include '../functions/db.php';

$customer = $_SESSION['viewing'];
removeCustomer($customer);
