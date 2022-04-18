<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$customer = $_POST['customer'];
include 'db.php';


if (isset($_POST['updateInfo'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $addr = $_POST['addr'];
    updateCustomer($customer, $fname, $lname, $uname, $email, $phone, $addr);
}

if (isset($_POST['updatePWD'])) {
    $currPwd = $_POST['currPwd'];
    $newPwd = $_POST['newPwd'];
    $newPwd2 = $_POST['newPwd2'];

    $data = getCustomerData($customer);
    $dbPwd = $data['password'];

    if ($newPwd !== $newPwd2) {
        echo 'Your new passwords do not match';
    } /*else if ($currPwd !== $dbPwd) {
        echo 'Incorrect current password.';
    } */ else {
        changePassword($customer, $newPwd);
    }
}
