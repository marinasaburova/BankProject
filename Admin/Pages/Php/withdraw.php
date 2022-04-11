<?php
$acctNum = $_POST['acctNum'];
$amount = $_POST['amount'];
$vendor = $_POST['vendor'];
include 'db.php';
withdraw($acctNum, $amount, $vendor);
