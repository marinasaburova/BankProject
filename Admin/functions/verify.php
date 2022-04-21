<?php

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
include '../functions/db.php';
emplogin($uname, $pwd);
