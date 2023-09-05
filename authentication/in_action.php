<?php
require ('./backEnd/DbC.php');

class in_action extends sql{

    public function account_update(){
        $data=$_POST;
        date_default_timezone_set("Asia/Dhaka");

        $updateed_on=date("Y-m-d h:i:s");
        $fast_name=$data['fast_name1'];
        $last_name=$data['last_name'];
        $birth_day=$data['birth_day'];
        $address=$data['address'];
        $number=$data['number'];
        $updateed_by='user';
        $id=$_SESSION['c_user']['id'];
        $errors = '';


        if(empty($data['fast_name1']) || empty($data['last_name']) || empty($data['birth_day'])){

                $errors.= 'Change only the things you need.';
        }
        if(!empty($errors)){
            $_SESSION['v_error'] = $errors;
            header("Location:http://localhost/shop/?page=my_account");
            exit;
        }
        if ($data['fast_name1'] == $_SESSION['c_user']['fast_name'] and $data['last_name'] == $_SESSION['c_user']['last_name'] and $data['birth_day'] == $_SESSION['c_user']['birth_day'] 
        and $data['address'] == $_SESSION['c_user']['address'] and $data['number'] == $_SESSION['c_user']['number'] and empty($_FILES['profile_pic']['name'])) {
            $_SESSION['error_msg']= "You did not change anything.";
            header("Location:http://localhost/shop/?page=my_account");
            exit;  
        }
        if (!empty($_FILES['profile_pic'])){
            $fname=$_SESSION['c_user']['email'];
            // if (empty($_SESSION['c_user']['profile_pic'])) {
            //     mkdir('./asset/profile/'.$fname,0777);
            // }
            $file_name='./asset/profile/'.$fname.'/profile.png';
            $file_path='./asset/profile/'.$fname.'/profile.png';
            move_uploaded_file($_FILES['profile_pic']['tmp_name'],$file_name);

            $query = "UPDATE reg SET 
            fast_name = '$fast_name',
            last_name = '$last_name',
            birth_day = '$birth_day',
            updateed_on = '$updateed_on',
            updateed_by = '$updateed_by',
            address = '$address',
            number = '$number',
            profile_pic = '$file_path'
            WHERE id = '$id'";
            
        }
        // if (empty($_FILES['profile_pic'])) {
        //     $query = "UPDATE reg SET 
        //     fast_name = '$fast_name',
        //     last_name = '$last_name',
        //     birth_day = '$birth_day'
        //     WHERE id = '$id'";
        //     print_r($_FILES['profile_pic']);
        //     exit;
            
        // }
        
        $result= $this->connect()->query($query);

        if ($result<=0) {
            $_SESSION['error_msg']= "Update did not succeed.";
            header("Location:http://localhost/shop/?page=my_account");
            exit;   
        }
            $query = "SELECT * from reg where id='$id'";
            $result = $this->connect()->query($query);
            if ($result->num_rows <= 0) {
                $_SESSION['error_msg']= "There is no account with this id.";
                header("Location:http://localhost/shop/?page=my_account");
                exit;
            }
        $user = $result->fetch_assoc();
        unset($_SESSION['c_user']);
        $_SESSION['c_user'] = $user;
        $_SESSION['suss_msg'] = "Successfully updated";
        header("Location:http://localhost/shop/?page=my_account");
        exit;
    }

    public function change_password(){
        $data=$_POST;
        date_default_timezone_set("Asia/Dhaka");

        $updateed_on=date("Y-m-d h:i:s");
        $password=$_SESSION['c_user']['password'];
        $old_password=hash('sha256',$data['old_password']);
        $new_password=hash('sha256',$data['new_password']);
        $confirm_password=$data['confirm_password'];
        $updateed_by='user';
        $id=$_SESSION['c_user']['id'];

        $errors = '';

        // echo '<pre>';
        // print_r($data);
        // exit;

        if ($password != $old_password) {
            $_SESSION['error_msg']= "Wrong password";
            header("Location:http://localhost/shop/?page=change_password");
            exit;
        }
        if ($confirm_password != $data['new_password']) {
            $_SESSION['error_msg']= "Confirm Password did not match.";
            header("Location:http://localhost/shop/?page=change_password");
            exit;
        }
        if(empty($data['old_password']) || empty($data['new_password']) || empty($data['confirm_password'])){

                $errors.= 'Change only the things you need.';
        }
        if(!empty($errors)){
            $_SESSION['v_error'] = $errors;
            header("Location:http://localhost/shop/?page=change_password");
            exit;
        }

            $query = "UPDATE reg SET 
            password = '$new_password',
            updateed_on = '$updateed_on',
            updateed_by = '$updateed_by'
            WHERE id = '$id'";
        
        $result= $this->connect()->query($query);

        if ($result<=0) {
            $_SESSION['error_msg']= "Password change did not succeed";
            header("Location:http://localhost/shop/?page=change_password");
            exit;   
        }
            $query = "SELECT * from reg where id='$id'";
            $result = $this->connect()->query($query);
            if ($result->num_rows <= 0) {
                $_SESSION['error_msg']= "There is no account with this id.";
                header("Location:http://localhost/shop/?page=change_password");
                exit;
            }
        $user = $result->fetch_assoc();
        unset($_SESSION['c_user']);
        $_SESSION['c_user'] = $user;
        $_SESSION['suss_msg'] = "Successfully Password Changed";
        header("Location:http://localhost/shop/?page=my_account");
        exit;
    }

    public function dashbord(){
        if ($_GET['action']=='dashbord' and $_SESSION['c_user']['authority'] != 'user') {
            date_default_timezone_set("Asia/Dhaka");
            $id=$_SESSION['c_user']['id'];
            $today = date('Y-m-d');
            $dashbord = [
                'today_completed_sales' => 0,
                'today_pending_sales' => 0,
                'total_product' => 0,
                'today_total_sales' => 0,
                'total_sales' => 0,
                'total_pending_sales' => 0,
                'total_pending_order' => 0,
                'total_completed_sales' => 0,
                'total_completed_order' => 0,
            ];

            $query = "SELECT SUM(total_price) AS today_completed_sales FROM `order` WHERE DATE(dv_updateed_on) = '$today' and dv_status='Completed' and status='Completed' and prodect_owner_id='$id';";
            $result = $this->connect()->query($query);
            $data=$result->fetch_assoc();
            $dashbord['today_completed_sales'] = is_null($data['today_completed_sales'])? 0 :$data['today_completed_sales'];

            $query = "SELECT SUM(total_price) AS today_pending_sales FROM `order` WHERE DATE(dv_updateed_on) = '$today' and dv_status='Pending' and status='Completed' and prodect_owner_id='$id';";
            $result = $this->connect()->query($query);
            $data=$result->fetch_assoc();
            $dashbord['today_pending_sales'] = is_null($data['today_pending_sales'])? 0 :$data['today_pending_sales'];

            $query = "SELECT SUM(total_price) AS today_total_sales FROM `order` WHERE dv_status='Pending' or status='Completed' and DATE(dv_updateed_on) = '$today' and prodect_owner_id='$id';";
            $result = $this->connect()->query($query);
            $data=$result->fetch_assoc();
            $dashbord['today_total_sales'] = is_null($data['today_total_sales'])? 0 :$data['today_total_sales'];

            $query = "SELECT SUM(total_price) AS total_completed_sales FROM `order` WHERE dv_status='Completed' and status='Completed' and prodect_owner_id='$id';";
            $result = $this->connect()->query($query);
            $data=$result->fetch_assoc();
            $dashbord['total_completed_sales'] = is_null($data['total_completed_sales'])? 0 :$data['total_completed_sales'];

            $query = "SELECT SUM(total_price) AS total_pending_sales FROM `order` WHERE dv_status='Pending' and status='Completed' and prodect_owner_id='$id';";
            $result = $this->connect()->query($query);
            $data=$result->fetch_assoc();
            $dashbord['total_pending_sales'] = is_null($data['total_pending_sales'])? 0 :$data['total_pending_sales'];

            $query = "SELECT SUM(total_price) AS total_sales FROM `order` WHERE dv_status='Pending' or status='Completed' and prodect_owner_id='$id';";
            $result = $this->connect()->query($query);
            $data=$result->fetch_assoc();
            $dashbord['total_sales'] = is_null($data['total_sales'])? 0 :$data['total_sales'];

            $query = "SELECT COUNT(*) AS total_product FROM prodect WHERE added_by='$id';";
            $result = $this->connect()->query($query);
            $data=$result->fetch_assoc();
            $dashbord['total_product'] = is_null($data['total_product'])? 0 :$data['total_product'];

            $query = "SELECT COUNT(*) AS total_pending_order FROM `order` WHERE dv_status='Pending' and status='Completed' and prodect_owner_id='$id';";
            $result = $this->connect()->query($query);
            $data=$result->fetch_assoc();
            $dashbord['total_pending_order'] = is_null($data['total_pending_order'])? 0 :$data['total_pending_order'];

            $query = "SELECT COUNT(*) AS total_completed_order FROM `order` WHERE dv_status='Completed' and status='Completed' and prodect_owner_id='$id';";
            $result = $this->connect()->query($query);
            $data=$result->fetch_assoc();
            $dashbord['total_completed_order'] = is_null($data['total_completed_order'])? 0 :$data['total_completed_order'];

            // echo '<pre>';
            // print_r($dashbord);
            // exit;
  
            $_SESSION['dashbord'] = $dashbord;
            header("Location:http://localhost/shop/?page=dashbord");

        }
    }

    public function accounts(){
        if ($_GET['action']=='accounts') {
            $authority=$_SESSION['c_user']['authority']; 
            if ($authority=='Moderator') {
                $query = "SELECT * from reg WHERE authority='Banned' or authority='User' or authority='Entrepreneur' or authority='Moderator'";
            }
            elseif ($authority=='Admin') {
                $query = "SELECT * from reg WHERE authority='Banned' or authority='User' or authority='Entrepreneur' or authority='Moderator' or authority='Admin'";
            }
            elseif ($authority=='Sudo') {
                $query = "SELECT * from reg";
            }
            else {
                $_SESSION['error_msg']= "Unauthorized action.";
                    header("Location:http://localhost/shop/?page=dashbord");
                    exit;
            }
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data accounts.";
                    unset($_SESSION['accounts']);
                    header("Location:http://localhost/shop/?page=dashbord");
                    exit;
                }
            $accounts = $result->fetch_all(1);
  
            $_SESSION['accounts'] = $accounts;
            header("Location:http://localhost/shop/?page=accounts");

        }
    }

    public function account_info(){
        if ($_GET['action']=='account_info') {
            $id=$_GET['id']; 
            $query = "SELECT * from reg WHERE id='$id'";
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data.";
                    header("Location:http://localhost/shop/?page=dashbord");
                    exit;
                }
            $account = $result->fetch_assoc();
            if (is_numeric($account['updateed_by'])) {
                $uid = $account['updateed_by'];
                $query1 = "SELECT fast_name,last_name,authority from reg WHERE id='$uid'";
                $result1 = $this->connect()->query($query1);
                $uname = $result1->fetch_assoc();
                $account['u_name'] = $uname['fast_name'].' '.$uname['last_name'].' ('.$uname['authority'].')'; 
            }else {
                $account['u_name'] = $account['updateed_by'] == 'user'? ucwords($account['updateed_by']):'None';
            }
            // echo '<pre>';
            // print_r($account);
            // exit;
            $_SESSION['account_info'] = $account;
            header("Location:http://localhost/shop/?page=account_info");

        }
    }

    public function account_info_change(){
        if ($_GET['action']=='account_info_change') {
            $id=$_GET['id']; 
            $query = "SELECT * from reg WHERE id='$id'";
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data.";
                    header("Location:http://localhost/shop/?page=accounts");
                    exit;
                }
            $account = $result->fetch_assoc();

            $_SESSION['account_info'] = $account;
            header("Location:http://localhost/shop/?page=account_info_change");

        }
    }
    
    public function account_info_change_action(){
        if ($_POST['action']=='account_info_change_action') {
            $data=$_POST;
            date_default_timezone_set("Asia/Dhaka");

            $updateed_on=date("Y-m-d h:i:s");
            $id=$_SESSION['account_info']['id'];

            $fast_name=$data['fast_name'];
            $last_name=$data['last_name'];
            $email=$data['email'];
            $birth_day=$data['birth_day'];
            $gender=$data['gender'];

            $sid=$_SESSION['c_user']['id'];

            $errors = '';

            // echo "<pre>";
            // print_r($data);
            // exit;

            if(empty($data['fast_name']) || empty($data['last_name']) || empty($data['email']) 
                || empty($data['birth_day']) || empty($data['authority']) || empty($data['gender']) ){

                $errors .= 'you did not fill this form properly.';
            }
            if(!empty($errors)){
                $_SESSION['v_error'] = $errors;
                header("Location:http://localhost/shop/?page=account_info_change");
                exit;
            }
            if (!empty($email)) {
                $query = "SELECT * from reg where email='$email'";

                $result = $this->connect()->query($query);
                $user = $result->fetch_assoc();
                print_r($user);

                if ($user['email']== $email) {
                    $_SESSION['error_msg'] = 'An account already exists with this email. Please try with another email.';
                header("Location:http://localhost/shop/?page=account_info_change");
                exit;
                }
            }
            // if ($data['fast_name1'] == $_SESSION['c_user']['fast_name'] and $data['last_name'] == $_SESSION['c_user']['last_name'] and $data['birth_day'] == $_SESSION['c_user']['birth_day'] 
            // and empty($_FILES['profile_pic']['name'])) {
            // $_SESSION['error_msg']= "You did not change anything.";
            // header("Location:http://localhost/shop/?page=account_setting");
            // exit;  
            // }
            // if ( strstr( $fast_name.$last_name, '\\' )){
            //     $_SESSION['error_msg'] = 'do not use (\\).';
            //     header("Location:http://localhost/shop/?page=prodect_change");
            //     exit;
            // }
            if (!empty($_SESSION['account_info']['authority'])) {

                $sauthority=$_SESSION['c_user']['authority'];
                echo "<pre>";
                
                if ($sauthority == $data['authority']) {

                    $_SESSION['error_msg']= "You can not give equal authority.";
                    header("Location:http://localhost/shop/?page=account_info_change");
                    exit;

                }
                elseif ($sauthority == 'Sudo') {
                    // echo $sauthority.'<br>';
                    // echo $data['authority'];
                    // exit;
                    $authority=$data['authority'];
                }
                elseif ($sauthority == 'Admin') {
                    if ($data['authority'] == 'Moderator' || $data['authority'] == 'Entrepreneur' 
                    || $data['authority'] == 'User' || $data['authority'] == 'Banned') {
            
                        $authority=$data['authority'];
                    }
                    else {
                        $_SESSION['error_msg']= "You can not give equal or higher authority.";
                        header("Location:http://localhost/shop/?page=account_info_change");
                        exit;
                    }  
                }
                elseif ($sauthority == 'Moderator') {
                    if ($data['authority'] == 'Entrepreneur' || $data['authority'] == 'User' || $data['authority'] == 'Banned') {
                        
                        $authority=$data['authority'];
                    }
                    else {
                        $_SESSION['error_msg']= "You can not give equal or higher authority.";
                        header("Location:http://localhost/shop/?page=account_info_change");
                        exit;
                    }  
                }
                else {
                    $_SESSION['error_msg']= "Unauthorised action1.";
                    header("Location:http://localhost/shop/?page=dashbord");
                    exit;
                }   
            }
            else {
                $_SESSION['error_msg']= "Unauthorised action.";
                header("Location:http://localhost/shop/?page=dashbord");
                exit;
            }
                $query = "UPDATE reg SET 
                fast_name = '$fast_name',
                last_name = '$last_name',
                email = '$email',
                birth_day = '$birth_day',
                gender = '$gender',
                updateed_by = '$sid',
                updateed_on = '$updateed_on',
                authority = '$authority'
                WHERE id = '$id'";

            $result= $this->connect()->query($query);

            if ($result<=0) {
                $_SESSION['error_msg']= "Registration did not succeed";
                header("Location:http://localhost/shop/?page=account_info_change");
                exit;   
            }
            $_SESSION['suss_msg']='Updating Account Info succeed';

            $query = "SELECT * from reg WHERE id='$id'";
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data.";
                    header("Location:http://localhost/shop/?page=account_info_change");
                    exit;
                }
            $account = $result->fetch_assoc();
            if (is_numeric($account['updateed_by'])) {
                $uid = $account['updateed_by'];
                $query1 = "SELECT fast_name,last_name,authority from reg WHERE id='$uid'";
                $result1 = $this->connect()->query($query1);
                $uname = $result1->fetch_assoc();
                $account['u_name'] = $uname['fast_name'].' '.$uname['last_name'].' ('.$uname['authority'].')'; 
            }else {
                $account['u_name'] = $account['updateed_by'] == 'user'? ucwords($account['updateed_by']):'None';
            }
            $_SESSION['account_info'] = $account;
            header("Location:http://localhost/shop/?page=account_info");

        }
    }

    public function deposit(){
        if ($_POST['action']=='deposit') {
            $data=$_POST; 

            $note=$data['note'];
            $deposit_amount=$data['deposit_amount'];
            $payment_type=$data['payment_type'];
            $transaction_id =$data['transaction_id'];
            $added_by=$_SESSION['c_user']['id'];
            $deposit_id='DP'.time();
            $status= 'Pending';

            // print_r($data);
            // echo $status;
            // exit;

            if(empty($data['deposit_amount']) || empty($data['payment_type']) || empty($data['transaction_id']) || empty($_SESSION['c_user']['id']) || empty($status) ){

            $errors = 'you did not fill this form properly.';

            }
            if(!empty($errors)){
                $_SESSION['v_error'] = $errors;
                header("Location:http://localhost/shop/?page=deposit");
                exit;
            }
            if (!empty($transaction_id)) {

                $query = "SELECT * from deposit where transaction_id='$transaction_id'";

                $result = $this->connect()->query($query);
                $user = $result->fetch_assoc();
                // print_r($user);

                if ($user['transaction_id']== $transaction_id) {
                    $_SESSION['error_msg'] = 'An Transaction ID already exists with this Transaction ID. Please try again.';
                header("Location:http://localhost/shop/?page=deposit");
                exit;
                }
            }

            $query = "INSERT INTO deposit (note,deposit_amount,payment_type,transaction_id,added_by,status,deposit_id) 
                    VALUES ('$note','$deposit_amount','$payment_type','$transaction_id','$added_by','$status','$deposit_id')";
        
            $result = $this->connect()->query($query);
                if ($result <= 0) {
                    $_SESSION['error_msg']= "There is a problem with this application.";
                    header("Location:http://localhost/shop/?page=deposit");
                    exit;
                }

            $_SESSION['suss_msg']='Deposit application submitted successful.';
            header("Location:http://localhost/shop/?page=deposit");

        }
    }
    
    public function deposit_list(){
        if ($_GET['action']=='deposit_list') {
            $authority=$_SESSION['c_user']['authority'];

            // echo $authority;
            // exit;

            if ($authority=="Sudo") {
                
            }

            if ( $authority=="Sudo" or $authority=="Admin") {
                
                $query = "SELECT * from deposit order by id desc";

                $result = $this->connect()->query($query);
                    if ($result->num_rows <= 0) {
                        $_SESSION['error_msg']= "There is no Data in list.";
                        unset($_SESSION['accounts']);
                        header("Location:http://localhost/shop/?page=dashbord");
                        exit;
                    }
                $deposit_list = $result->fetch_all(1);
    
                $_SESSION['deposit_list'] = $deposit_list;
                header("Location:http://localhost/shop/?page=deposit_list");
                
            }else {
                $_SESSION['error_msg']= "Unauthorized action.";
                header("Location:http://localhost/shop/?action=home");
                exit;
            }
        }
    }

    public function update_deposit(){
        $data=$_GET;
        date_default_timezone_set("Asia/Dhaka");

        $status= $data['action'] == 'update_deposit_r'? 'Accepted':'Cancelled';
        $updateed_on=date("Y-m-d h:i:s");
        $updateed_by=$_SESSION['c_user']['id'];
        $id=$data['id'];

        // echo '<pre>';
        // print_r($status);
        // exit;


            $query = "UPDATE deposit SET 
            status = '$status',
            updateed_on = '$updateed_on',
            updateed_by = '$updateed_by'
            WHERE id = '$id'";
        
        $result= $this->connect()->query($query);

        if ($result<=0) {
            $_SESSION['error_msg']= "Password change did not succeed";
            header("Location:http://localhost/shop/?action=deposit_list");
            exit;   
        }


        if ($status == 'Accepted') {
            
            $query1 = "SELECT * from deposit where id='$id'";
            $result = $this->connect()->query($query1);
            $deposit = $result->fetch_assoc();
            if ($result->num_rows <= 0) {
                $_SESSION['error_msg']= "There is no deposit application with this id.";
                header("Location:http://localhost/shop/?action=deposit_list");
                exit;
            }

            $uid = $deposit['added_by'];
            $deposit_amount = $deposit['deposit_amount'];
            
            $query2 = "UPDATE reg SET 
            balance = '$deposit_amount',
            updateed_on = '$updateed_on',
            updateed_by = '$updateed_by'
            WHERE id = '$uid'";
        
            $result= $this->connect()->query($query2);

            // echo $query2;
            // exit;

            if ($result<=0) {
                $_SESSION['error_msg']= "Balance change did not succeed";
                header("Location:http://localhost/shop/?action=deposit_list");
                exit;   
            }
        }
            $query = "SELECT * from deposit";
            $result = $this->connect()->query($query);
            if ($result->num_rows <= 0) {
                $_SESSION['error_msg']= "There is no deposit application.";
                header("Location:http://localhost/shop/?action=deposit_list");
                exit;
            }
        $deposit_list = $result->fetch_all(1);
        $query = "SELECT * from reg where id='$updateed_by'";
            $result = $this->connect()->query($query);
            if ($result->num_rows <= 0) {
                $_SESSION['error_msg']= "There is no account with this id.";
                header("Location:http://localhost/shop/?page=my_account");
                exit;
            }
        $user = $result->fetch_assoc();
        unset($_SESSION['c_user']);
        $_SESSION['c_user'] = $user;
        $_SESSION['deposit_list'] = $deposit_list;
        $_SESSION['suss_msg'] = "Successfully Deposit ".$status;
        header("Location:http://localhost/shop/?page=deposit_list");
        exit;
    }

//<-------------------------------------------------------------About Prodect--------------------------------------------------------------------->
    public function abb_new_prodect(){
        $data=$_POST;

        $prodect_name1=$data['prodect_name'];
        $prodect_name=str_replace("'","\\'","$prodect_name1");
        $prodect_code=$data['prodect_code'];
        $buying_price=$data['buying_price'];
        $selling_price=$data['selling_price'];
        $prodect_picture=$_FILES['prodect_picture'];
        $status=$data['status'];
        $type=$data['type'];
        $description1=$data['description'];
        $description=str_replace("'","\\'","$description1");

        $id=$_SESSION['c_user']['id'];
        $errors = '';


        if(empty($data['prodect_name']) || empty($data['prodect_code']) || empty($data['buying_price']) || empty($data['selling_price']) 
            || empty($data['status']) || empty($data['description']) || empty($data['type'])){

                $errors.= 'you need to fill everything that has a (*).';
        }
        if(!empty($errors)){
            $_SESSION['v_error'] = $errors;
            header("Location:http://localhost/shop/?page=add_new_prodect");
            exit;
        }
        if ( strstr( $description, '\\' ) ) {
            $_SESSION['error_msg'] = 'do not use (\\).';
            header("Location:http://localhost/shop/?page=add_new_prodect");
            exit;
        }
        if ( strstr( $prodect_name, '\\' ) ) {
            $_SESSION['error_msg'] = 'do not use (\\).';
            header("Location:http://localhost/shop/?page=add_new_prodect");
            exit;
        }
        if (!empty($prodect_code)) {
            $query = "SELECT * from prodect where prodect_code='$prodect_code'";

            $result = $this->connect()->query($query);
            $user = $result->fetch_assoc();

            if ($user['prodect_code']== $prodect_code) {
                $_SESSION['error_msg'] = 'A product with this code already exists.';
            header("Location:http://localhost/shop/?page=add_new_prodect");
            exit;
            }
        }

        mkdir('./asset/prodect/'.$prodect_code,0777);

        if (!empty($prodect_picture)) {
            $file_name='./asset/prodect/'.$prodect_code.'/prodect.png';
            $file_path='./asset/prodect/'.$prodect_code.'/prodect.png';
            move_uploaded_file($_FILES['prodect_picture']['tmp_name'],$file_name);
            $query = "INSERT INTO prodect (prodect_name,prodect_code,buying_price,selling_price,status,description,type,prodect_picture,added_by) 
                VALUES ('$prodect_name','$prodect_code','$buying_price','$selling_price','$status','$description','$type','$file_path','$id')";
        }
        // else{
        //     $query = "INSERT INTO prodect (prodect_name,prodect_code,buying_price,selling_price,added_by) 
        //         VALUES ('$prodect_name','$prodect_code','$buying_price','$selling_price','$id')";
        // }

        $result= $this->connect()->query($query);

        if ($result<=0) {
            $_SESSION['error_msg']= "Registration did not succeed";
            header("Location:http://localhost/shop/?page=add_new_prodect");
            exit;   
        }
        $_SESSION['suss_msg']='Abbing New Prodect succeed';
        header("Location:http://localhost/shop/?page=add_new_prodect");
        exit;
    }

    public function prodect_list(){
        if ($_GET['action']=='prodect_list') {

            $query = "SELECT * from prodect order by id desc";

            if ($_SESSION['c_user']['authority'] == 'Entrepreneur') {
                $sid=$_SESSION['c_user']['id'];
                $query = "SELECT * from prodect where added_by='$sid' order by id desc";
            }

        $result = $this->connect()->query($query);
            if ($result->num_rows <= 0) {
                $_SESSION['error_msg']= "There is no Data in prodect list.";
                unset($_SESSION['prodects']);
                header("Location:http://localhost/shop/?page=prodect_list");
                exit;
            }
        $prodects = $result->fetch_all(1);

        $_SESSION['prodects'] = $prodects;
        header("Location:http://localhost/shop/?page=prodect_list");

        }
    }
    
    public function prodect_info(){
        if ($_GET['action']=='prodect_info') {
            $id=$_GET['id']; 
            $query = "SELECT * from prodect WHERE id='$id';";
            // $query = "SELECT prodect.*, reg.fast_name, reg.last_name
            //     FROM prodect
            //     INNER JOIN reg ON prodect.added_by = reg.id Where prodect.id='$id';";
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data.";
                    header("Location:http://localhost/shop/?page=prodect_list");
                    exit;
                }
            $prodect = $result->fetch_assoc();

            $aid=$prodect['added_by'];
            $uid=!empty($prodect['updateed_by'])? $prodect['updateed_by'] : "";

            $query1="SELECT fast_name,last_name,authority from reg WHERE id='$aid';";
            $result1 = $this->connect()->query($query1);

            $aname = $result1->fetch_assoc();
            $prodect['a_name'].= $aname['fast_name'].' '.$aname['last_name'].' ('.$aname['authority'].')';

            $query2="SELECT fast_name,last_name,authority from reg WHERE id='$uid';";

            $result2 = $this->connect()->query($query2);
            $uname = $result2->fetch_assoc();
            if (!empty($uname)) {
                $prodect['u_name'].= $uname['fast_name'].' '.$uname['last_name'].' ('.$uname['authority'].')';
            }
            $prodect['u_name'].= '';

            $_SESSION['prodect_info'] = $prodect;
            header("Location:http://localhost/shop/?page=prodect_info");
            exit;
        }
    }

    public function prodect_delete(){
        if ($_GET['action']=='prodect_delete') {
            $id = $_GET['id']; 
            $code = $_SESSION['prodect_info']['prodect_code'];
            $dir='./asset/prodect/'.$code;
            $file = $dir.'/prodect.png';

            $query = "SELECT * FROM `order` WHERE prodect_id='$id';";
            $result = $this->connect()->query($query);
            if ($result->num_rows >= 1) {
                $_SESSION['error_msg']= "There exist an order with this product.";

                $query = "SELECT * from prodect order by id desc";

                if ($_SESSION['c_user']['authority'] == 'Entrepreneur') {
                    $sid=$_SESSION['c_user']['id'];
                    $query = "SELECT * from prodect where added_by='$sid' order by id desc";
                }
    
                $result = $this->connect()->query($query);
                    if ($result->num_rows <= 0) {
                        $_SESSION['error_msg']= "There is no Data in prodect list.";
                        unset($_SESSION['prodects']);
                        header("Location:http://localhost/shop/?action=prodect_list");
                        exit;
                    }
                $prodects = $result->fetch_all(1);
        
                $_SESSION['prodects'] = $prodects;
                header("Location:http://localhost/shop/?page=prodect_list");
                exit;
            }

                unlink($file);
                rmdir($dir);

            $query = "DELETE FROM prodect WHERE id='$id';";
            // $query = "SELECT prodect.*, reg.fast_name, reg.last_name
            //     FROM prodect
            //     INNER JOIN reg ON prodect.added_by = reg.id Where prodect.id='$id';";
            $result = $this->connect()->query($query);
                if ($result <= 0) {
                    $_SESSION['error_msg']= "Delete did not succeed.";
                    header("Location:http://localhost/shop/?page=prodect_list");
                    exit;
                }
                
                $query = "SELECT * from prodect order by id desc";

                if ($_SESSION['c_user']['authority'] == 'Entrepreneur') {
                    $sid=$_SESSION['c_user']['id'];
                    $query = "SELECT * from prodect where added_by='$sid' order by id desc";
                }
    
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data in prodect list.";
                    unset($_SESSION['prodects']);
                    header("Location:http://localhost/shop/?action=prodect_list");
                    exit;
                }
            $prodects = $result->fetch_all(1);
    
            $_SESSION['prodects'] = $prodects;
            $_SESSION['suss_msg']='Deleted successfully';
            header("Location:http://localhost/shop/?page=prodect_list");
            exit;
        }
    }
    
    public function abb_stock(){
        if ($_POST['action']=='abb_stock') {
            $id=$_POST['id']; 
            $add=$_POST['abb_stock1']; 
            $sid=$_SESSION['c_user']['id'];

            if (!is_numeric($add)) {
                $_SESSION['error_msg']= "Please put an integer number.";
                header("Location:http://localhost/shop/?page=prodect_info");
                exit;
            }
            
            $query = "SELECT * from prodect WHERE id='$id'";
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data with this prodect.";
                    header("Location:http://localhost/shop/?action=prodect_list");
                    exit;
                }
            $prodect = $result->fetch_assoc();
            $added=$prodect['total_in_stock'] + $add;

            if ($added < 0) {
                $_SESSION['error_msg']= "You can not decrease more than your stored.";
                header("Location:http://localhost/shop/?page=prodect_info");
                exit;
            }

                $query = "UPDATE prodect SET 
                total_in_stock = '$added',
                updateed_by = '$sid'
                WHERE id = '$id'";

            $result= $this->connect()->query($query);

            if ($result<=0) {
                $_SESSION['error_msg']= "Registration did not succeed";
                header("Location:http://localhost/shop/?page=prodect_info");
                exit;   
            }
            $_SESSION['suss_msg']='Updating Prodect Info succeed';
 
            $query = "SELECT * from prodect WHERE id='$id'";
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data.";
                    header("Location:http://localhost/shop/?page=prodect_info");
                    exit;
                }
            $prodect = $result->fetch_assoc();
            $aid=$prodect['added_by'];
            $uid=!empty($prodect['updateed_by'])? $prodect['updateed_by'] : "";

            $query1="SELECT fast_name,last_name,authority from reg WHERE id='$aid';";
            $result1 = $this->connect()->query($query1);
            $aname = $result1->fetch_assoc();

            $query2="SELECT fast_name,last_name,authority from reg WHERE id='$uid';";
            $result2 = $this->connect()->query($query2);
            $uname = $result1->fetch_assoc();

            $prodect['a_name'].= $aname['fast_name'].' '.$aname['last_name'].' ('.$aname['authority'].')';

            $uname = $result2->fetch_assoc();
            if (!empty($uname)) {
                $prodect['u_name'].= $uname['fast_name'].' '.$uname['last_name'].' ('.$uname['authority'].')';
            }
            $prodect['u_name'].= '';

            $_SESSION['prodect_info'] = $prodect;
            header("Location:http://localhost/shop/?page=prodect_info");
            exit;

        }
    }

    public function prodect_change(){
        if ($_GET['action']=='prodect_change') {
            $id=$_GET['id']; 
            $query = "SELECT * from prodect WHERE id='$id'";
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data.";
                    header("Location:http://localhost/shop/?page=prodect_list");
                    exit;
                }
            $prodect = $result->fetch_assoc();

            $_SESSION['prodect_info'] = $prodect;
            header("Location:http://localhost/shop/?page=prodect_change");

        }
    }

    public function prodect_change_action(){
        if ($_POST['action']=='prodect_change_action') {
            $data=$_POST;
            date_default_timezone_set("Asia/Dhaka");

            $updateed_on=date("Y-m-d h:i:s");
            $prodect_name1=$data['prodect_name'];
            $prodect_name=str_replace("'","\\'","$prodect_name1");
            $prodect_code=$_SESSION['prodect_info']['prodect_code'];
            $buying_price=$data['buying_price'];
            $selling_price=$data['selling_price'];
            $prodect_picture=$_FILES['prodect_picture'];
            $status=$data['status'];
            $discount=$data['discount'];
            $type=$data['type'];
            $description1=$data['description'];
            $description=str_replace("'","\\'","$description1");

            $id=$_SESSION['prodect_info']['id'];
            $sid=$_SESSION['c_user']['id'];

            $errors = '';

            // echo "<pre>";
            // print_r($data);
            // exit;

            if(empty($data['prodect_name']) || empty($prodect_code) || empty($data['buying_price']) || empty($data['selling_price']) 
                || empty($data['status']) || empty($data['description']) || empty($data['discount']) || empty($data['type'])){

                    $errors.= 'you did not fill this form properly.';
            }
            if(!empty($errors)){
                $_SESSION['v_error'] = $errors;
                header("Location:http://localhost/shop/?page=prodect_change");
                exit;
            }
            if ( strstr( $description, '\\' ) ) {
                $_SESSION['error_msg'] = 'do not use (\\).';
                header("Location:http://localhost/shop/?page=prodect_change");
                exit;
            }
            // if ($data['fast_name1'] == $_SESSION['c_user']['fast_name'] and $data['last_name'] == $_SESSION['c_user']['last_name'] and $data['birth_day'] == $_SESSION['c_user']['birth_day'] 
            // and empty($_FILES['profile_pic']['name'])) {
            // $_SESSION['error_msg']= "You did not change anything.";
            // header("Location:http://localhost/shop/?page=account_setting");
            // exit;  
            // }
            if ($_SESSION['c_user']['authority'] == 'Entrepreneur' and $_SESSION['prodect_info']['status'] == 'Banned') {
                $_SESSION['error_msg'] = 'You can not change anything because this product is Banned.';
                header("Location:http://localhost/shop/?page=prodect_change");
                exit;
            }
            // if (!empty($prodect_code)) {
            //     $query = "SELECT * from prodect where prodect_code='$prodect_code'";

            //     $result = $this->connect()->query($query);
            //     $user = $result->fetch_assoc();

            //     if ($user['prodect_code']== $prodect_code) {
            //         $_SESSION['error_msg'] = 'A product with this code already exists.';
            //     header("Location:http://localhost/shop/?page=add_new_prodect");
            //     exit;
            //     }
            // }

            if (!empty($prodect_picture)) {
                $file_name='./asset/prodect/'.$prodect_code.'/prodect.png';
                $file_path='./asset/prodect/'.$prodect_code.'/prodect.png';
                move_uploaded_file($_FILES['prodect_picture']['tmp_name'],$file_name);

                $query = "UPDATE prodect SET 
                prodect_name = '$prodect_name',
                buying_price = '$buying_price',
                selling_price = '$selling_price',
                description = '$description',
                discount = '$discount',
                type = '$type',
                status = '$status',
                prodect_picture = '$file_path',
                updateed_on = '$updateed_on',
                updateed_by = '$sid'
                WHERE id = '$id'";

               
            }

            $result= $this->connect()->query($query);

            if ($result<=0) {
                $_SESSION['error_msg']= "Prodect change did not succeed";
                header("Location:http://localhost/shop/?page=prodect_change");
                exit;   
            }
            $_SESSION['suss_msg']='Updating Prodect Info succeed';
 
            $query = "SELECT * from prodect WHERE id='$id'";
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data in it.";
                    header("Location:http://localhost/shop/?page=prodect_change");
                    exit;
                }
            $prodect = $result->fetch_assoc();
            $aid=$prodect['added_by'];
            $uid=!empty($prodect['updateed_by'])? $prodect['updateed_by'] : "";

            $query1="SELECT fast_name,last_name,authority from reg WHERE id='$aid';";
            $result1 = $this->connect()->query($query1);
            $aname = $result1->fetch_assoc();

            $query2="SELECT fast_name,last_name,authority from reg WHERE id='$uid';";
            $result2 = $this->connect()->query($query2);
            $uname = $result1->fetch_assoc();

            $prodect['a_name'].= $aname['fast_name'].' '.$aname['last_name'].' ('.$aname['authority'].')';

            $uname = $result2->fetch_assoc();
            if (!empty($uname)) {
                $prodect['u_name'].= $uname['fast_name'].' '.$uname['last_name'].' ('.$uname['authority'].')';
            }
            $prodect['u_name'].= '';

            $_SESSION['prodect_info'] = $prodect;
            header("Location:http://localhost/shop/?page=prodect_info");
            exit;
        }
    }
//<-------------------------------------------------------------About User--------------------------------------------------------------------->
    public function home(){
        if ($_GET['action']=='home') {

        $queryg = "SELECT * from prodect where status='Active' and type='General'";
        $queryc = "SELECT * from prodect where status='Active' and type='Clothing'";
        $queryt = "SELECT * from prodect where status='Active' and type='Technology'";
        $queryf = "SELECT * from prodect where status='Active' and type='Food'";
        $querys = "SELECT * from prodect where status='Active' and type='Service'";

        $General = $this->connect()->query($queryg);
        $Clothing = $this->connect()->query($queryc);
        $Technology = $this->connect()->query($queryt);
        $Food = $this->connect()->query($queryf);
        $Service = $this->connect()->query($querys);
 
        $General_p = $General->fetch_all(1);
        $Clothing_p = $Clothing->fetch_all(1);
        $Technology_p = $Technology->fetch_all(1);
        $Food_p = $Food->fetch_all(1);
        $Service_p = $Service->fetch_all(1);

        if (empty($General_p) and empty($Clothing_p) and empty($Technology_p) and empty($Food_p) and empty($Service_p)) {

            $_SESSION['error_msg']= "There is no Prodect.";
            unset($_SESSION['prodects']);
            header("Location:http://localhost/shop/?page=home");
            exit;
        }

        $_SESSION['general_p'] = $General_p;
        $_SESSION['clothing_p'] = $Clothing_p;
        $_SESSION['technology_p'] = $Technology_p;
        $_SESSION['food_p'] = $Food_p;
        $_SESSION['service_p'] = $Service_p;

        header("Location:http://localhost/shop/?page=home");
        exit;
        }
    }
       
    public function prodect_details(){
        if ($_GET['action']=='prodect_details') {

        $id=$_GET['id'];

        $query = "SELECT * from prodect where status='Active' and id='$id'";

        $result = $this->connect()->query($query);
        if ($result->num_rows <= 0) {
            $_SESSION['error_msg']= "There is no Data in it.";
            header("Location:http://localhost/shop/?action=home");
            exit;   
        }
 
        $prodect_details = $result->fetch_assoc();


        $_SESSION['prodect_details'] = $prodect_details;
        header("Location:http://localhost/shop/?page=prodect_details");
        exit;

        }
    }
    
    public function add_to_cart(){
        if ($_POST['action']=='add_to_cart') {
            $id=$_POST['id']; 
            $sid=$_SESSION['c_user']['id'];

            $query = "SELECT * from `order` WHERE prodect_id='$id' and ordered_by='$sid' and status='Pending'";

            $result = $this->connect()->query($query);
                if ($result->num_rows >= 1) {

                    $_SESSION['error_msg']= "You already added this prodect in your Cart.";
                    header("Location:http://localhost/shop/?action=home");
                    exit;
                }
            $prodect = $result->fetch_assoc();
            
            $query = "SELECT * from prodect WHERE id='$id'";
            
            $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Data with this prodect.";
                    
                    header("Location:http://localhost/shop/?action=home");
                    exit;
                }
            $prodect = $result->fetch_assoc();

            $prodect_id=$prodect['id'];
            $order_number = 'ORD'.time();
            $quantity = $_POST['quantity']; 
            $number = $_SESSION['c_user']['number'];
            $ordered_by = $_SESSION['c_user']['id'];
            $address = $_SESSION['c_user']['address'];
            $prodect_owner_id = $prodect['added_by'];
            $status = 'Pending';
            $dv_status = 'Not started';

            // print_r($dv_status);
            // exit;
        
            if (empty($_SESSION['c_user']['address']) || empty($_SESSION['c_user']['number'])) {
                $_SESSION['error_msg']= "Please update your address and phone number from my account.";
                header("Location:http://localhost/shop/?action=prodect_details&id=$id");
                exit;
            }
            if (!is_numeric($_POST['quantity'])) {
                $_SESSION['error_msg']= "Please put an integer number.";
                header("Location:http://localhost/shop/?action=prodect_details&id=$id");
                exit;
            }
            if ($_POST['quantity'] > $prodect['total_in_stock']) {

                $_SESSION['error_msg']= "Please put a number that is not bigger than in Stock.";
                header("Location:http://localhost/shop/?action=prodect_details&id=$id");
                exit;
            }
            if(empty($prodect['id']) || empty($order_number) || empty($_POST['quantity']) || empty($_SESSION['c_user']['number']) 
                || empty($_SESSION['c_user']['id']) || empty($_SESSION['c_user']['address']) || empty($prodect['added_by']) || $status != 'Pending' || $dv_status != 'Not started'){

                    $errors = 'unauthorised action.';
            }
            if(!empty($errors)){
                $_SESSION['v_error'] = $errors;
                header("Location:http://localhost/shop/?action=home");
                exit;
            }

                $query ="INSERT INTO `order` (prodect_id,order_number,quantity,number,ordered_by,address,prodect_owner_id,status,dv_status) 
                VALUES ('$prodect_id','$order_number','$quantity','$number','$ordered_by','$address','$prodect_owner_id','$status','$dv_status')";

            $result= $this->connect()->query($query);

            if ($result<=0) {
                $_SESSION['error_msg']= "Add to the cart did not succeed";
                header("Location:http://localhost/shop/?action=home");
                exit;   
            }

            $_SESSION['suss_msg']='Added to the cart';
 
            header("Location:http://localhost/shop/?action=home");
            exit;
        }
    }

    public function cart(){
        if ($_GET['action']=='cart') {

            $id=$_SESSION['c_user']['id'];

            // $query = "SELECT * from `order` where ordered_by='$id' and status='Pending'";
            $query = "SELECT `order`.* , prodect.selling_price, prodect.prodect_name, prodect.total_in_stock, prodect.discount, prodect.prodect_picture, prodect.id as 'pid'
                FROM `order`
                INNER JOIN prodect
                ON `order`.prodect_id = prodect.id where `order`.ordered_by='$id' and `order`.status='Pending' and prodect.status='Active' order by `order`.id desc;";

            $result = $this->connect()->query($query);
            if ($result->num_rows <= 0) {
                unset($_SESSION['cart']);
                $_SESSION['error_msg']= "There is added product in cart.";
                header("Location:http://localhost/shop/?page=cart");
                exit;   
            }
    
            $cart = $result->fetch_all(1);

            $_SESSION['cart'] = $cart;
            header("Location:http://localhost/shop/?page=cart");
            exit;
        }
    }

    public function order_delete(){
        if ($_GET['action']=='order_delete') {
            $id = $_GET['id']; 
            $sid=$_SESSION['c_user']['id'];

            $query = "DELETE FROM `order` WHERE id='$id';";
            // $query = "SELECT prodect.*, reg.fast_name, reg.last_name
            //     FROM prodect
            //     INNER JOIN reg ON prodect.added_by = reg.id Where prodect.id='$id';";
            $result = $this->connect()->query($query);
                if ($result <= 0) {
                    $_SESSION['error_msg']= "Delete did not succeed.";
                    header("Location:http://localhost/shop/?page=cart");
                    exit;
                }
            $query = "SELECT `order`.* , prodect.selling_price, prodect.prodect_name, prodect.total_in_stock, prodect.discount, prodect.prodect_picture, prodect.id as 'pid'
                FROM `order`
                INNER JOIN prodect
                ON `order`.prodect_id = prodect.id where `order`.ordered_by='$sid' and `order`.status='Pending' and prodect.status='Active' order by `order`.id desc;";

            $result = $this->connect()->query($query);
            if ($result->num_rows <= 0) {
                unset($_SESSION['cart']);
                $_SESSION['error_msg']= "There is added product in cart.";
                header("Location:http://localhost/shop/?page=cart");
                exit;   
            }
    
            $cart = $result->fetch_all(1);

            $_SESSION['cart'] = $cart;
            $_SESSION['suss_msg']='Deleted successfully';
            header("Location:http://localhost/shop/?page=cart");
            exit;
        }
    }
    
    public function buy(){
        if ($_POST['action']=='buy') {

            $sid=$_SESSION['c_user']['id'];

            // $query = "SELECT * from `order` where ordered_by='$id' and status='Pending'";
            $query = "SELECT `order`.* , prodect.selling_price, prodect.prodect_name, prodect.total_in_stock, prodect.discount, prodect.prodect_picture, prodect.id as 'pid'
                FROM `order`
                INNER JOIN prodect
                ON `order`.prodect_id = prodect.id where `order`.ordered_by='$sid' and `order`.status='Pending' and prodect.status='Active' order by `order`.id desc;";

            $result = $this->connect()->query($query);
            if ($result->num_rows <= 0) {
                $_SESSION['error_msg']= "There is no Data in it.";
                header("Location:http://localhost/shop/?action=home");
                exit;   
            }
    
            $cart = $result->fetch_all(1);

            $data= !empty($cart)? $cart:'';
            $count= !empty($data)? count($data):'';


            if ($count <= 0 ) {
                $_SESSION['error_msg']="Nothing is added to the cart.";
                exit;
            }
            for ($i=0; $i < $count; $i++) {

                date_default_timezone_set("Asia/Dhaka");

                $updateed_on=date("Y-m-d h:i:s");
                $id= $data[$i]['id'];
                $pid = $data[$i]['prodect_id'];
                $total= 0;
                $status = 'Completed';
                $dv_status = 'Pending';

                // Price:
                if (empty($data[$i]['discount'])) { 
                        $price = $data[$i]['selling_price'];
                } else { 
                    $price = ($data[$i]['selling_price'] - $data[$i]['discount']);
                }

                if ($data[$i]['total_in_stock'] != 0 and $data[$i]['total_in_stock'] >= $data[$i]['quantity']) {

                    $total =(floatval($data[$i]['quantity'])*floatval($price));
                    $total_in_stock = $data[$i]['total_in_stock'] - $data[$i]['quantity'];

                }else {
                    $_SESSION['error_msg']="Nothing is added to the cart.";
                    header("Location:http://localhost/shop/?action=cart");
                    exit;
                } 
                $query = "UPDATE `order` SET 
                total_price = '$total',
                buying_price = '$price',
                status = '$status',
                dv_status = '$dv_status',
                updateed_on = '$updateed_on'
                WHERE id = '$id'";

                $result= $this->connect()->query($query);
                if ($result<=0) {
                    $_SESSION['error_msg']= "Buying did not succeed";
                    header("Location:http://localhost/shop/?action=cart");
                    exit;   
                }

                $query = "SELECT * from reg where id='$sid'";
                $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no account with this id.";
                    header("Location:http://localhost/shop/?page=my_account");
                    exit;
                }

                $user = $result->fetch_assoc();
                $balance= $user['balance'];
                $c_balance = floatval($balance) - floatval($total);

                $query = "UPDATE reg SET 
                balance = '$c_balance'
                WHERE id = '$sid'";

                // print_r($query);
                // exit;

                $result= $this->connect()->query($query);
                if ($result<=0) {
                    $_SESSION['error_msg']= "Buying did not succeed";
                    header("Location:http://localhost/shop/?action=cart");
                    exit;   
                }

                $query = "UPDATE prodect SET 
                total_in_stock = '$total_in_stock'
                WHERE id = '$pid'";

                // print_r($query);
                // exit;

                $result= $this->connect()->query($query);
                if ($result<=0) {
                    $_SESSION['error_msg']= "Buying did not succeed";
                    header("Location:http://localhost/shop/?action=cart");
                    exit;   
                }
                    
            }

            $query = "SELECT * from reg where id='$sid'";
                $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no account with this id.";
                    header("Location:http://localhost/shop/?page=my_account");
                    exit;
                }
                $user = $result->fetch_assoc();
                unset($_SESSION['c_user']);
                $_SESSION['c_user'] = $user;

                $_SESSION['suss_msg']='Buying succeed';
                header("Location:http://localhost/shop/?action=cart");
                exit;
        }
    }
    
    public function order_list(){
        if ($_GET['action']=='order_list') {


            $sid=$_SESSION['c_user']['id'];
            $after = "and `order`.dv_status='Pending'";

            // $query = "SELECT * from `order` where ordered_by='$id' and status='Pending'";
            $query = "SELECT `order`.* , prodect.selling_price, prodect.prodect_name, prodect.total_in_stock, prodect.discount, prodect.prodect_picture, prodect.id as 'pid'
                FROM `order`
                INNER JOIN prodect
                ON `order`.prodect_id = prodect.id where `order`.prodect_owner_id='$sid' and `order`.status='Completed' order by `order`.id desc;";

            $result = $this->connect()->query($query);
            if ($result->num_rows <= 0) {
                $_SESSION['error_msg']= "There is no Order Pending.";
                header("Location:http://localhost/shop/?action=order_list");
                exit;   
            }
    
            $order_list = $result->fetch_all(1);

            $_SESSION['order_list'] = $order_list;
            // $_SESSION['suss_msg']='Deleted successfully';
            header("Location:http://localhost/shop/?page=order_list");
            exit;
        }
    }
    
    public function order_complete(){
        if ($_GET['action']=='order_complete') {

            date_default_timezone_set("Asia/Dhaka");

            $updateed_on=date("Y-m-d h:i:s");
            $id = $_GET['id'];
            $sid=$_SESSION['c_user']['id'];
            $after = "and `order`.dv_status='Pending'";
    
            // $query = "SELECT * from `order` where ordered_by='$id' and status='Pending'";
                
                $query = "SELECT * FROM `order` where id='$id';";

                $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no Order Pending.";
                    header("Location:http://localhost/shop/?action=order_list");
                    exit;   
                }
        
                $order_info = $result->fetch_assoc();
                $total= $order_info['total_price'];

                $query = "UPDATE `order` SET 
                dv_status = 'Completed',
                dv_updateed_on = '$updateed_on'
                WHERE id = '$id'";

                $result= $this->connect()->query($query);
                if ($result<=0) {
                    $_SESSION['error_msg']= "Buying did not succeed";
                    header("Location:http://localhost/shop/?page=order_list");
                    exit;   
                }

                $query = "SELECT * from reg where id='$sid'";
                $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no account with this id.";
                    header("Location:http://localhost/shop/?page=my_account");
                    exit;
                }

                $user = $result->fetch_assoc();
                $balance= $user['balance'];
                $c_balance = floatval($balance) + floatval($total);

                $query = "UPDATE reg SET 
                balance = '$c_balance'
                WHERE id = '$sid'";

                // print_r($query);
                // exit;

                $result= $this->connect()->query($query);
                if ($result<=0) {
                    $_SESSION['error_msg']= "Buying did not succeed";
                    header("Location:http://localhost/shop/?action=cart");
                    exit;   
                }

                $query = "SELECT * from reg where id='$sid'";
                $result = $this->connect()->query($query);
                if ($result->num_rows <= 0) {
                    $_SESSION['error_msg']= "There is no account with this id.";
                    header("Location:http://localhost/shop/?page=my_account");
                    exit;
                }
                $user = $result->fetch_assoc();
                unset($_SESSION['c_user']);
                $_SESSION['c_user'] = $user;


    
            $query = "SELECT `order`.* , prodect.selling_price, prodect.prodect_name, prodect.total_in_stock, prodect.discount, prodect.prodect_picture, prodect.id as 'pid'
                FROM `order`
                INNER JOIN prodect
                ON `order`.prodect_id = prodect.id where `order`.prodect_owner_id='$sid' and `order`.status='Completed' order by `order`.id desc;";

            $result = $this->connect()->query($query);
            if ($result->num_rows <= 0) {
                $_SESSION['error_msg']= "There is no Order Pending.";
                header("Location:http://localhost/shop/?action=order_list");
                exit;   
            }
    
            $order_list = $result->fetch_all(1);

            $_SESSION['order_list'] = $order_list;
            // $_SESSION['suss_msg']='Deleted successfully';
            header("Location:http://localhost/shop/?page=order_list");
            exit;
        }
    }
}

?>