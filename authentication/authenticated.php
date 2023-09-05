<?php
session_start();

require('./authentication/in_action.php');
$inaction = new in_action();

if (!isset($_SESSION['c_user'])) {
    header("Location:./logwork.php?logaction=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' and (isset($_GET['action']) and !empty($_GET['action']))) {

    $action = !empty($_GET['action'])? $_GET['action']:'';

    

    if ($action=='logout') {
        session_unset();
        header("Location:./");
        exit;   
    }
    elseif ($action=='prodect_list') {
        $inaction->prodect_list();
    }
    elseif ($action=='prodect_info') {
        $inaction->prodect_info();
    }
    elseif ($action=='prodect_change') {
        $inaction->prodect_change();
    }
    elseif ($action=='accounts') {
        $inaction->accounts();
    }
    elseif ($action=='account_info') {
        $inaction->account_info();
    }
    elseif ($action=='prodect_delete') {
        $inaction->prodect_delete();
    }
    elseif ($action=='account_info_change') {
        $inaction->account_info_change();
    }
    elseif ($action=='home') {
        $inaction->home();
    }
    elseif ($action=='prodect_details') {
        $inaction->prodect_details();
    }
    elseif ($action=='deposit_list') {
        $inaction->deposit_list();
    }
    elseif ($action=='update_deposit_r' or $action=='update_deposit_c' ) {
        $inaction->update_deposit();
    }
    elseif ($action=='cart') {
        $inaction->cart();
    }
    elseif ($action=='order_delete') {
        $inaction->order_delete();
    }
    elseif ($action=='order_list') {
        $inaction->order_list();
    }
    elseif ($action=='order_complete') {
        $inaction->order_complete();
    }
    elseif ($action=='dashbord') {
        $inaction->dashbord();
    }
    
    else {
        $_SESSION['error_msg']= "Unauthorised action.";
        header("Location:http://localhost/shop/");
        exit;
    }
    
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' and (isset($_POST['action']) and !empty($_POST['action']))) {

    $action=$_POST['action'];
    $_SESSION['old_data'] = $_POST;
    // echo $action;
    // exit;

    if ($action=='account_update') {
        $inaction->account_update();
    }
    elseif ($action=='abb_new_prodect') {
        $inaction->abb_new_prodect();
    }
    elseif ($action=='prodect_change_action') {
        $inaction->prodect_change_action();
    }
    elseif ($action=='change_password') {
        $inaction->change_password();
    }
    elseif ($action=='account_info_change_action') {
        $inaction->account_info_change_action();
    }
    elseif ($action=='abb_stock') {
        $inaction->abb_stock();
    }
    elseif ($action=='add_to_cart') {
        $inaction->add_to_cart();
    }
    elseif ($action=='deposit') {
        $inaction->Deposit();
    }
    elseif ($action=='buy') {
        $inaction->buy();
    }
    
    else {
        $_SESSION['error_msg']= "Unauthorised action.";
        header("Location:http://localhost/shop/");
        exit;
    }
    

    exit;
}

?>