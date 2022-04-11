<?php
$uname = $_POST['email'];
$pwd = $_POST['pass'];
include 'db.php';
login($uname, $pwd);