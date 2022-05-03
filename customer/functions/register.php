<?php

if (!isset($_POST['registerCustomer'])) {
    header('Location: ../Pages/login.php');
    exit;
}

$pin = '1234';

$fname = trim(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_ADD_SLASHES));
$lname = trim(filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_ADD_SLASHES));
$uname = trim(filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_ADD_SLASHES));
$email = strtolower(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
$addr = trim(filter_input(INPUT_POST, 'addr', FILTER_SANITIZE_ADD_SLASHES));
$pwd = filter_input(INPUT_POST, 'pwd');


include 'db.php';

register($fname, $lname, $uname, $email, $phone, $addr, $pwd, $pin);
exit;
