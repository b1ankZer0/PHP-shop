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

?>

<h1 class="center">Account Info Change</h1><hr>
<div class=" flax bg-color1" style="width:100%; height: 650px; padding:auto; border:1px solid #B2B1B9;">
    <div class='' style="width:48%; height:100%; margin:auto; text-align: laft; justify-content: laft;">
        <form action="http://localhost/shop/" method="post" enctype="multipart/form-data" class="pad" style="margin-left: 0%;">
            <input type="hidden" name="action" value="account_info_change_action"><br><br><br><br>

        <label class="txt-size1 color margin" for="fast_name">Fast Name:</label><br><br>
        <input class="input" type="text" name="fast_name" id="fast_name" value="<?php echo isset($old['fast_name'])? $old['fast_name']: $info['fast_name']; ?>" ><br><br>

        <!-- <label class="txt-size1 color margin" for="prodect_code">Prodect Code:</label><br>
        <input class="input" type="text" name="prodect_code" id="prodect_code" placeholder="Prodect Code" > -->

        <label class="txt-size1 color margin" for="last_name">Last Name:</label><br><br>
        <input class="input" type="text" name="last_name"  id="last_name" value="<?php echo isset($old['last_name'])? $old['last_name']: $info['last_name']; ?>"><br><br>

        <label class="txt-size1 color margin" for="email">Email:</label><br><br>
        <input class="input" type="email" name="email"  id="email" value="<?php echo isset($old['email'])? $old['email']: $info['email']; ?>" ><br><br>

        <label class="txt-size1 color margin" for="birth_day">Birth Day:</label><br><br>
        <input class="input" type="date" name="birth_day"   id="birth_day" value="<?php echo isset($old['birth_day'])? $old['birth_day']: $info['birth_day']; ?>" ><br><br>


    </div>

    <div style=" border:1px solid #B2B1B9; width:0%; height:85%; margin:auto;">
        
    </div>

    <div class='' style="width:48%; height:100%; margin:auto; padding-left: 30px; text-align: laft; justify-content: laft;"><br><br><br><br>
        <?php if (isset($old['authority'])) { ?>
            <label class="txt-size1 color margin" for="authority">Authority:</label><br><br> 
            <select name="authority" id="authority" class="select">
                <option value="Admin" <?php echo $old['authority']=='Admin'?'selected':'';?>>Admin</option>
                <option value="Moderator" <?php echo $old['authority']=='Moderator'?'selected':'';?>>Moderator</option>
                <option value="Entrepreneur" <?php echo $old['authority']=='Entrepreneur'?'selected':'';?>>Entrepreneur</option>
                <option value="User" <?php echo $old['authority']=='User'?'User':'';?>>User</option>
                <option value="Banned" <?php echo $old['authority']=='Banned'?'selected':'';?>>Banned</option>
            </select><br><br>
        <?php }else { ?>
            <label class="txt-size1 color margin" for="authority">Authority:</label><br><br> 
            <select name="authority" id="authority" class="select">
                <option value="Admin" <?php echo $info['authority']=='Admin'?'selected':'';?>>Admin</option>
                <option value="Moderator" <?php echo $info['authority']=='Moderator'?'selected':'';?>>Moderator</option>
                <option value="Entrepreneur" <?php echo $info['authority']=='Entrepreneur'?'selected':'';?>>Entrepreneur</option>
                <option value="User" <?php echo $info['authority']=='User'?'User':'';?>>User</option>
                <option value="Banned" <?php echo $info['authority']=='Banned'?'selected':'';?>>Banned</option>
            </select><br><br>
        <?php } ?>
        <?php if (isset($old['gender'])) { ?>
            <label class="txt-size1 color margin" for="gender">Gender:</label><br><br> 
            <select name="gender" id="gender" class="select">
                <option value="Male" <?php echo $old['gender']=='Male'?'selected':'';?>>Male</option>
                <option value="Female" <?php echo $old['gender']=='Female'?'selected':'';?>>Female</option>
                <option value="Others" <?php echo $old['gender']=='Others'?'selected':'';?>>Others</option>
            </select><br><br>
        <?php }else { ?>
            <label class="txt-size1 color margin" for="gender">Gender:</label><br><br> 
            <select name="gender" id="gender" class="select">
                <option value="Male" <?php echo $info['gender']=='Male'?'selected':'';?>>Male</option>
                <option value="Female" <?php echo $info['gender']=='Female'?'selected':'';?>>Female</option>
                <option value="Others" <?php echo $info['gender']=='Others'?'selected':'';?>>Others</option>
            </select><br><br>
        <?php } ?>
    </div>
</div>
<div class='center' style="width:50%; height:120px; margin:auto;">

        <button class="button" type="submit" style="margin-top:30px; margin-left: 0px;">Update Account Info</button>
        </form>

</div>
