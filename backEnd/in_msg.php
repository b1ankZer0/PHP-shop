<?php

    $v_error = isset($_SESSION['v_error']) ? $_SESSION['v_error'] : "";
    $msg2 = !empty($v_error) ? $v_error : "";
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



    // class msg{
    //     public function imsg(){
    //         $v_error = isset($_SESSION['v_error']) ? $_SESSION['v_error'] : "";
    //         $msg2 = !empty($v_error) ? $v_error : "";
    //         unset($_SESSION['v_error']);

    //         $msg=null;
    //         $status = null;

    //         if (isset($_SESSION['error_msg'])) {
    //             $msg = $_SESSION['error_msg'];
    //             unset($_SESSION['error_msg']);
    //         }
    //         return($msg.$msg2);
    //     }

    // }

?>