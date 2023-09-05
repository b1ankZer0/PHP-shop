<?php

include('./config/info.php');

if ($_SESSION['c_user']['authority']=='User') {

    $_GET['page']= isset($_GET['page']) ? $_GET['page'] : "home";

}

$page = isset($_GET['page']) ? $_GET['page'] : "home";

class open{
    public function page($page){
        if (!empty($page)) {
            $path='./page/'.$page.'.php';
            
            if(file_exists($path)){
                
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
                include('./page/'.$page.'.php');
                exit;
            }else{
                header("Location:./?page=error");
                exit;
            }
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
        }
        else {
            $_SESSION['error_msg']= "Unauthorised action.";
            header("Location:./?page=error");
            exit;
        }
    }
}

if (!empty($_SESSION['c_user'])) {
    include('./page/index.php');
    exit;
}

?>
