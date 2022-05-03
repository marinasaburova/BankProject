<?php
if (!isset($_POST['submitLogin'])) {
    header('Location: ../Pages/login.php');
    exit;
}

$uname = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_ADD_SLASHES);
$pwd = filter_input(INPUT_POST, 'pwd');

include '../functions/db.php';
login($uname, $pwd);
exit;
