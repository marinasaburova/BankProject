<?php
$from = $_POST['acctFrom'];
$to = $_POST['acctTo'];
$amount = $_POST['amount'];
include 'db.php';
transfer($from, $to, $amount);
