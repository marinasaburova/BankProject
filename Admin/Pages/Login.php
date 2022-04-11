<?php
$uname = $_POST['email'];
$pwd = $_POST['pass'];
include 'db.php';
emplogin($uname, $pwd);
