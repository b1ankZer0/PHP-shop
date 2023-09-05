<?php


$page=isset($_GET['logaction'])? $_GET['logaction']:'login';
class logwork{
    public function page($page){

        if (empty($page)) {
            echo "unathoraze action";
            // include('./page/login.php');
            exit;
        }
        if (!empty($page)) {
            $path='./page/'.$page.'.php';
            
            if(file_exists($path)){
                include('./backEnd/msg.php');
                include('./page/'.$page.'.php');
                exit;
            }
            if (isset($_SESSION['c_user'])) {
                header("Location:./");
                exit;
            }
            else{
                $_SESSION['error_msg']= "Unauthorised action.";
                header("Location:./");
                exit;
            }
            
            
            
            exit;
        }
    }
}

$logwork = new logwork;
$logwork->page($page);





// if(empty($_SESSION['c_user'])){
//     include('./page/login.php');
//     exit;
// }
?>