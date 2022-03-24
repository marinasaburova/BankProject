<?php
$title = "Dashboard";

// include functions & files 
include '../functions/db.php';
include '../view/header.php';
include '../view/navigation.php';

$acctNum = $_GET['account'];
$_SESSION['account'] = $acctNum;
