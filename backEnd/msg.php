<?php
session_start();

$v_error = isset($_SESSION['v_error']) ? $_SESSION['v_error'] : "";
$msg2 = !empty($v_error) ? $v_error : "";
$msg2= !empty($v_error) ? $v_error : "";
unset($_SESSION['v_error']);

$msg=null;
$status = null;

if (isset($_SESSION['error_msg'])) {
    $msg = $_SESSION['error_msg'];
    unset($_SESSION['error_msg']);
}
$suss_msg=null;
$status = null;

if (isset($_SESSION['suss_msg'])) {
    $suss_msg= $_SESSION['suss_msg'];
    unset($_SESSION['suss_msg']);
}

$old_data=null;

if (isset($_SESSION['old_data'])) {
    $old_data= $_SESSION['old_data'];
    unset($_SESSION['old_data']);
}

if (isset($old_data)) {
    $old=$old_data;
}else {
    $old='';
}

?>