<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$addr = $_POST['addr'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
$pin = '1234';
include 'db.php';

if ($pwd !== $pwd) {
    echo 'Error: your passwords need to match.';
    echo '<a class = "link" href=../register.php>Try again.</a>';
    exit;
}

register($fname, $lname, $uname, $email, $phone, $addr, $pwd, $pin);
