<?php
$type = $_POST['type'];
$customer = $_POST['customer'];
$deposit = $_POST['deposit'];
include 'db.php';

createBankAcct($type, $deposit, $customer);
