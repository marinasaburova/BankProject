<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$addr = $_POST['addr'];
$pwd = $_POST['pwd'];
$pin = '1234';
include 'db.php';

register($fname, $lname, $uname, $email, $phone, $addr, $pwd, $pin);
