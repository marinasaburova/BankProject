<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
include 'db.php';

if ($pwd !== $pwd) {
    echo 'Error: your passwords need to match.';
}

global $db;
