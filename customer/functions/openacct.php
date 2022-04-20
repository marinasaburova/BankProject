    <?php
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
        exit;
    }
    $type = $_POST['type'];
    $customer = $_SESSION['customer'];
    include 'db.php';
    requestBankAcct($type, $customer);
    ?>
