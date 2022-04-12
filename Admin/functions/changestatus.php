<?php
include 'db.php';

if (isset($_POST['approve'])) {
    $acctNum = $_POST['acctNum'];
    changeStatus($acctNum, 'active');
}

if (isset($_POST['deny'])) {
    $acctNum = $_POST['acctNum'];
    changeStatus($_POST['acctNum'], 'denied');
}
