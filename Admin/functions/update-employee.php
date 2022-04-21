<?php
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

include 'db.php';
$employee = $_SESSION['employee'];

if (isset($_POST['updateInfo'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $addr = $_POST['addr'];
    updateEmployee($employee, $fname, $lname, $uname, $email, $phone, $addr);
}

if (isset($_POST['updatePWD'])) {
    $currPwd = $_POST['currPwd'];
    $newPwd = $_POST['newPwd'];
    $newPwd2 = $_POST['newPwd2'];

    $data = getEmployeeData($employee);
    $dbPwd = $data['password'];

    if ($newPwd !== $newPwd2) {
        echo 'Your new passwords do not match';
    } else if ($currPwd !== $dbPwd) {
        echo 'Incorrect current password.';
    } else {
        changeEmpPassword($employee, $newPwd);
    }
}
