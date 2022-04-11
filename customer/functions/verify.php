<?php
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
include '../functions/db.php';
login($uname, $pwd);
