<?php
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

if (!isset($_POST['updateInfo']) && !isset($_POST['updatePWD'])) {
    header('Location: ../Pages/dashboard.php');
    exit;
}

$customer = $_POST['customer'];
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

if (isset($_POST['updatePWD'])) {
    $currPwd = filter_input(INPUT_POST, 'currPwd', FILTER_SANITIZE_ADD_SLASHES);
    $newPwd = filter_input(INPUT_POST, 'newPwd', FILTER_SANITIZE_ADD_SLASHES);

    $data = getCustomerData($customer);
    $hash = $data['password'];

    if (!password_verify($currPwd, $hash)) {
        header('Location: ../Pages/edit-info.php?msg=pwdError');
        exit;
    } else {
        changePassword($customer, $newPwd);
    }
    exit;
}

exit;
