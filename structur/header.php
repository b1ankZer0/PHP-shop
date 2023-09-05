
    <div class="flax" style="width:100%; ">

        <div class="mid" style="width:15%; height: 80px;">
            <a href="<?php echo BASE_URL.'?action=home' ?>">
                <img class="logo" src="./asset/logo.jpg" alt="logo">
            </a>
        </div>
        <div class="flax mid" style="width:65%; height: 80px; float:right; right:30px">
            <div class="flax mid" style="width:80%; height: 100px; margin-left: 45%;">
                <a class="a-header" href="<?php echo BASE_URL.'?action=home' ?>">Home</a>
                <a class="a-sidebar" href="<?php echo BASE_URL.'?action=cart' ?>">Cart</a>
                <a class="a-header" href="<?php echo BASE_URL.'?page=deposit' ?>">Deposit</a>
                <a class="a-header" href="<?php echo BASE_URL.'?page=my_account' ?>">My Account</a>
                <a class="a-header" href="<?php echo BASE_URL.'?action=logout' ?>">logout</a>
            </div>
        </div>

        <div class="mid" style="width:20%; height: 80px; place-items: center;">
            <a href="#">
                <img class="profile mid" style="margin-top: 10px;" 
                src="<?php echo file_exists($_SESSION['c_user']['profile_pic'])?$_SESSION['c_user']['profile_pic']:"./asset/profile.png" ?>" alt="profile pic">
            </a>
            
        </div>

    </div>