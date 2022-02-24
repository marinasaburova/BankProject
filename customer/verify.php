<?php
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
include '../customer/functions/db.php';
login($uname, $pwd);
