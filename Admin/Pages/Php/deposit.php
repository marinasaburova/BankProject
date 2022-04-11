<?php
$acctNum = $_POST['acctNum'];
$amount = $_POST['amount'];
$vendor = $_POST['vendor'];
include 'db.php';
deposit($acctNum, $amount, $vendor);
