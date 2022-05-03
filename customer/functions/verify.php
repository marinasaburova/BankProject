<?php
$uname = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_ADD_SLASHES);
$pwd = filter_input(INPUT_POST, 'pwd');

include '../functions/db.php';
login($uname, $pwd);
