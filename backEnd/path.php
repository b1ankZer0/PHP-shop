<?php
require '../authentication/authentication.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' and (isset($_POST['action']) and !empty($_POST['action']))) {

    $action=$_POST['action'];
    $_SESSION['old_data'] = $_POST;

    $authentication = new authentication();

    if ($action=='login') {
        $authentication->login();
    }

    elseif ($action=='reg') {
        $authentication->reg();
    }
    elseif ($action=='logout') {
        $authentication->logout();
    }
    elseif ($action=='forget_password') {
        $authentication->forget_password();
    }
    elseif ($action=='reset_password') {
        $authentication->reset_password();
    }

    else {
        $_SESSION['error_msg']= "Unauthorised action.";
        header("Location:http://localhost/shop/");
        exit;
    }

exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' || isset($_POST['action']) and !empty($_GET['action'])) {

    $action = $_GET['action'];

// $authentication = new authentication();

// if ($action=='forget_password') {
//     $authentication->pforget_password();
// }

// if ($action=='reg') {
//     $authentication->reg();
// }
// if ($action=='logout') {
//     $authentication->logout();
// }

// else {
//     $_SESSION['error_msg']= "Unauthorised action.";
//     header("Location:http://localhost/shop/");
//     exit;
// }
$_SESSION['error_msg']= "Unauthorised action.";
    header("Location:http://localhost/shop/");
    exit;
exit;
}



?>