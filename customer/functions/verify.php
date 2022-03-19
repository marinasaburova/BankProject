<?php
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
include 'db.php';
login($uname, $pwd);