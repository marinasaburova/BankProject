<?php
// NEED TO FIX
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

include 'db.php';

$customer = $_SESSION['viewing'];
removeCustomer($customer);

exit;
