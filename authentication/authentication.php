<?php

require '../backEnd/DbC.php';


class authentication extends sql{

    public function login(){
        if ($_POST['action'] == 'login') {

            $data = $_POST;
            $email = $data['email'];
            $password = hash('sha256',$data['password']) ;
            $errors = "";

            if(empty($data['email']) || empty($data['password']) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors= 'Email and Password field is required';
            }        
            if(!empty($errors)){
                $_SESSION['v_error'] = $errors;
                header("Location:http://localhost/shop/logwork.php?logaction=login");
                exit;
            }
            
            if (empty($errors)) {

                $query = "SELECT * from reg where email='$email' and password='$password'";

                $result = $this->connect()->query($query);

                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no account with this combination.";
                    header("Location:http://localhost/shop/");
                    // header("Location:../page/login.php");
                    exit;
                }
                $user = $result->fetch_assoc();
                if ($user['authority']=='Banned') {
                    $_SESSION['error_msg']= "You are Banned.Contact here (admin.ashik@gmail.com)";
                    header("Location:http://localhost/shop/");
                    exit;
                }
                $_SESSION['c_user'] = $user;
                header("Location:http://localhost/shop/?action=home");
                exit;
            }
        }
    }
    public function reg(){
        if ($_POST['action'] == 'reg') {
            $data = $_POST;
            $fast_name = $data['fast_name'];
            $last_name = $data['last_name'];
            $email = $data['email'];
            $birth_day=$data['birth_day'];
            $gender=$data['gender'];
            $password =hash('sha256',$data['password']) ;
            $authority = 'user';

            $errors = '';
            if(empty($data['fast_name']) || empty($data['last_name']) || empty($data['email']) || empty($data['birth_day']) 
             ||empty($data['gender']) || empty($data['password']) || empty($data['cpassword']) || strlen($data['password']) < 6){

                $errors.= 'you did not fill this form properly.';
            }
            if(!empty($errors)){
                $_SESSION['v_error'] = $errors;
                header("Location:http://localhost/shop/logwork.php?logaction=reg");
                exit;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_msg'] = 'Plz, Give A Valid Email.';
                header("Location:http://localhost/shop/logwork.php?logaction=reg");
                exit;
            }
            if ($data['password'] != $data['cpassword']) {
                $_SESSION['error_msg'] = 'Those passwords didn’t match. Try again.';
                header("Location:http://localhost/shop/logwork.php?logaction=reg");
                exit;
            }

            if (!empty($email)) {
                $query = "SELECT * from reg where email='$email'";

                $result = $this->connect()->query($query);
                $user = $result->fetch_assoc();
                print_r($user);

                if ($user['email']== $email) {
                    $_SESSION['error_msg'] = 'An account already exists with this email. Please try with another email.';
                header("Location:http://localhost/shop/logwork.php?logaction=reg");
                exit;
                }
            }
            if (!empty($_FILES)){

                $fname=$data['email'];
                mkdir('../asset/profile/'.$fname,0777);
                $file_name='../asset/profile/'.$fname.'/profile.png';
                $file_path='./asset/profile/'.$fname.'/profile.png';
                move_uploaded_file($_FILES['profile_pic']['tmp_name'],$file_name);
            }

            $query = "INSERT INTO reg (fast_name,last_name,email,birth_day,gender,profile_pic,password,authority) 
                VALUES ('$fast_name','$last_name','$email','$birth_day','$gender','$file_path','$password','$authority')";
    
            $result= $this->connect()->query($query);

            if ($result<=0) {  
                $_SESSION['error_msg']= "Registration did not succeed";
                header("Location:http://localhost/shop/logwork.php?logaction=reg");
                exit;   
            }
            
            $_SESSION['suss_msg']='Registration succeed';
            header("Location:http://localhost/shop/logwork.php?logaction=login");
            exit;
            
        }
    }
    
    public function forget_password(){
        $data = $_POST;
        $errors = '';
        $email = $data['email'];
        $birth_day= $data['birth_day'];


        if(empty($data['email']) || empty($data['birth_day']) || !filter_var($email, FILTER_VALIDATE_EMAIL)){

                $errors.= 'you did not fill this form properly.';
            }
        if(!empty($errors)){
                $_SESSION['v_error'] = $errors;
                header("Location:http://localhost/shop/logwork.php?logaction=forget_password");
                exit;
            }

        $query = "SELECT * from reg where email='$email' and birth_day='$birth_day'";

        $result = $this->connect()->query($query);
        $user = $result->fetch_assoc();

        if ($user['email'] != $email || $user['birth_day'] != $birth_day) {
            $_SESSION['error_msg'] = 'An account with this combination does not exist.';
            header("Location:http://localhost/shop/logwork.php?logaction=forget_password");
        exit;
        }
        if ($user['email'] == $email || $user['birth_day'] == $birth_day) {
            $_SESSION['reset_email'] = $user['email'];
            header("Location:http://localhost/shop/logwork.php?logaction=reset_password");
        exit;
        }
    }
    public function reset_password(){
        $data = $_POST;
        $errors = '';

        // if (isset($_SESSION['reset_email'])) {
        //     header("Location:http://localhost/shop/");
        //     exit;
        // }
        $email = $_SESSION['reset_email'];
        $password = hash('sha256', $data['password']);


        if(empty($data['password']) || empty($data['cpassword']) || strlen($data['password']) < 6){

                $errors.= 'you did not fill this form properly.';
            }
        if(!empty($errors)){
                $_SESSION['v_error'] = $errors;
                header("Location:http://localhost/shop/logwork.php?logaction=reset_password");
                exit;
            }
        if ($data['password'] != $data['cpassword']) {
                $_SESSION['error_msg'] = 'Those passwords didn’t match. Try again.';
                header("Location:http://localhost/shop/logwork.php?logaction=reset_password");
                exit;
            }

        $query = "UPDATE reg 
        SET password = '$password'
        WHERE email = '$email'";
    
        $result= $this->connect()->query($query);

        if ($result<=0) {
            $_SESSION['error_msg']= "Password change did not succeed";
            header("Location:http://localhost/shop/logwork.php?logaction=reset_password");
            exit;   
        }
        header("Location:http://localhost/shop/logwork.php?logaction=login");
        exit;
    }



    public function logout(){

        if ($_GET['action'] == 'logout') {
            unset($_SESSION['c_user']);
            header("Location:../");
            exit;   
        }
    }
}

?>