</pre>
<?php 
if ($_SESSION['c_user']['authority'] == 'Sudo' || $_SESSION['c_user']['authority'] == 'Admin' 
|| $_SESSION['c_user']['authority'] == 'Moderator') {
}
else {
    $_SESSION['error_msg']= "Unauthorised action.";
    header("Location:http://localhost/shop/?page=dashboed");
    exit;
}
$info=$_SESSION['account_info'];
$id=$info['id'];

?>
<div class="flax" style="width:100%; height:50px;">
    <div style="margin-left: 20px;">
        <h1>Account Info</h1> 
    </div>
    <div style="margin-left: 72%; margin-top: 5px;">
        <?php echo $_SESSION['c_user']['authority']!=$info['authority']? "<a class='a_button' href=".BASE_URL.'?action=account_info_change&id='.$id ." style='text-decoration: none;'><i style='font-size:16px color:#ffffff' class='fas'>&#xf044;</i></a>":'';?>
        <!-- <a class="a_button" href="<?php echo BASE_URL.'?page=add_new_prodect' ?>" style="text-decoration: none;">Add New +</a> -->
    </div>
</div>
    <hr>
<div class=" flax bg-color1" style="width:100%; height: 750px; padding:auto; border:1px solid #B2B1B9;">
    <div class='' style="width:48%; height:100%; margin:auto; text-align: laft; justify-content: laft;">
        <form action="http://localhost/shop/" method="post" enctype="multipart/form-data" class="pad" style="margin-left: 0%;"><br><br><br>
        
        <label class="txt-size color margin" for="prodect_picture">Profile Picture:</label><br><br>
        <img class="prodect_picture" src="<?php echo file_exists($info['profile_pic'])? $info['profile_pic']:"./asset/profile.png"?>" alt="Profile Picture"><br><br>

        <label class="txt-size color margin" for="prodect_name">Fast Name:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['fast_name'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Last Name:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['last_name'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Email:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['email'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Phone Number:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['number'];?></label><br><br>

    </div>

    <div style=" border:1px solid #B2B1B9; width:0%; height:90%; margin:auto;">
        
    </div>

    <div class='' style="width:48%; height:100%; margin:auto; text-align: laft; justify-content: laft;"><br><br><br>
    
        <label class="txt-size color margin" for="prodect_code">Balance:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['balance'].' tk';?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Authority:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['authority'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Birth Day:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['birth_day'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Gender:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['gender'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Address:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['address'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Last Updateed By:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo !empty($info['u_name'])? $info['u_name']: 'none' ;?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Registered On:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['reg time'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">last Updateed On:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['updateed_on'];?></label><br><br>
    
    </div>
</div>
<div class='center' style="width:50%; height:100px; margin:auto; padding-top:30px">
    <!-- <?php echo $_SESSION['c_user']['authority']!=$info['authority']? "<a class='a_button' href=".BASE_URL.'?action=account_info_change&id='.$id ." style='text-decoration: none;'>Change</a>":'';?> -->
    </form>
</div>
