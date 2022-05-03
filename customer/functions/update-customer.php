<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_POST['updateInfo']) && !isset($_POST['updatePWD'])) {
    header('Location: ../Pages/edit-info.php');
    exit;
}


$customer = $_SESSION['customer'];
include 'db.php';

if (isset($_POST['updateInfo'])) {

    $fname = trim(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_ADD_SLASHES));
    $lname = trim(filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_ADD_SLASHES));
    $uname = trim(filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_ADD_SLASHES));
    $email = strtolower(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $addr = trim(filter_input(INPUT_POST, 'addr', FILTER_SANITIZE_ADD_SLASHES));

    updateCustomer($customer, $fname, $lname, $uname, $email, $phone, $addr);
    exit;
}

// NEED TO FIX
if (isset($_POST['updatePWD'])) {

    $currPwd = filter_input(INPUT_POST, 'currPwd', FILTER_SANITIZE_ADD_SLASHES);
    $newPwd = filter_input(INPUT_POST, 'newPwd', FILTER_SANITIZE_ADD_SLASHES);
    $newPwd2 = filter_input(INPUT_POST, 'newPwd2', FILTER_SANITIZE_ADD_SLASHES);

    $data = getCustomerData($customer);
    $dbPwd = $data['password'];

    if ($newPwd !== $newPwd2) {
        echo 'Your new passwords do not match';
    } else if ($currPwd !== $dbPwd) {
        echo 'Incorrect current password.';
    } else {
        changePassword($customer, $newPwd);
    }
    exit;
}
exit;
