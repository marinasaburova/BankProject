<?php
session_start();

if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

include 'db.php';
$employee = $_SESSION['employee'];

if (!isset($_GET['empUpdateInfo']) && !isset($_GET['empUpdatePWD'])) {
    header('Location: ../Pages/dashboard.php');
    exit;
}

if (isset($_POST['empUpdateInfo'])) {
    $fname = trim(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_ADD_SLASHES));
    $lname = trim(filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_ADD_SLASHES));
    $uname = trim(filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_ADD_SLASHES));
    $email = strtolower(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);

    updateEmployee($employee, $fname, $lname, $uname, $email, $phone);
    exit;
}

if (isset($_POST['empUpdatePWD'])) {
    $currPwd = filter_input(INPUT_POST, 'currPwd', FILTER_SANITIZE_ADD_SLASHES);
    $newPwd = filter_input(INPUT_POST, 'newPwd', FILTER_SANITIZE_ADD_SLASHES);
    $newPwd2 = filter_input(INPUT_POST, 'newPwd2', FILTER_SANITIZE_ADD_SLASHES);

    $data = getEmployeeData($employee);
    $dbPwd = $data['password'];

    if ($newPwd !== $newPwd2) {
        echo 'Your new passwords do not match';
    } else if ($currPwd !== $dbPwd) {
        echo 'Incorrect current password.';
    } else {
        changeEmpPassword($employee, $newPwd);
    }
    exit;
}

exit;
