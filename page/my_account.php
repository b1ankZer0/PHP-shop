
<div class=" flax bg-color1" style="width:100%; height: 1050px; padding:auto;">
    <div class='' style="width:48%; height:100%; margin:auto; text-align: laft; justify-content: laft;">
            <h1 class='center' style="margin-top:30px;">Old Info</h1><hr>
            <label class="txt-size color margin" for="name">Profile picture:</label><br>
            <img class="profile2" style="margin: 10px 30%;" 
                src="<?php echo file_exists($_SESSION['c_user']['profile_pic'])?$_SESSION['c_user']['profile_pic']:"./asset/profile.png"?>" alt="profile pic">
            <label class="txt-size color margin" for="fname">Fast Name:</label><br>
            <label class="txt-size1 " for="name"><?php echo $_SESSION['c_user'] ['fast_name']?></label><br>
            <label class="txt-size color margin" for="name">Last Name:</label><br>
            <label class="txt-size1 " for="name"><?php echo $_SESSION['c_user'] ['last_name']?></label><br>
            <label class="txt-size color margin" for="name">Birth Date:</label><br>
            <label class="txt-size1 " for="name"><?php echo $_SESSION['c_user'] ['birth_day']?></label><br>
            <label class="txt-size color margin" for="name">Email:</label><br>
            <label class="txt-size1 " for="name"><?php echo $_SESSION['c_user'] ['email']?></label><br>
            <label class="txt-size color margin" for="name">Authority:</label><br>
            <label class="txt-size1 " for="name"><?php echo $_SESSION['c_user'] ['authority']?></label><br>
            <label class="txt-size color margin" for="name">Phone number:</label><br>
            <label class="txt-size1 " for="name"><?php echo !empty($_SESSION['c_user'] ['number'])?$_SESSION['c_user'] ['number']:'none'; ?></label><br>
            <label class="txt-size color margin" for="name">Address:</label><br>
            <label class="txt-size1 " for="name"><?php echo !empty($_SESSION['c_user'] ['address'])?$_SESSION['c_user'] ['address']: 'none'; ?></label><br>
            <label class="txt-size color margin" for="name">Balance:</label><br>
            <label class="txt-size1 " for="name"><?php echo $_SESSION['c_user'] ['balance'].' tk';?></label><br>
    </div>

    <div style=" border:1px solid #B2B1B9; width:0%; height:96%; margin:auto;">
        
    </div>

    <div class='' style="width:48%; height:100%; margin:auto; text-align: laft; justify-content: laft;">
        <form action="http://localhost/shop/" method="post" enctype="multipart/form-data"  style="margin-top:-25px;">

            <h1 class='center'>Update new Info</h1><hr>
            <input type="hidden" name="action" value="account_update">
            <label class="txt-size color margin" for="fname">Fast Name:</label><br>
            <input class="input" type="text" name="fast_name1" id="fname" 
                value="<?php echo isset($old['fast_name1'])? $old['fast_name1']: $_SESSION['c_user'] ['fast_name']; ?>"  placeholder="new fast name"><br>

            <label class="txt-size color margin" for="lname">Last Name:</label><br>
            <input class="input" type="text" name="last_name" id="lname"
                value="<?php echo isset($old['last_name'])? $old['last_name']: $_SESSION['c_user'] ['last_name']; ?>"  placeholder="new last name"><br>

            <label class="txt-size color margin" for="date">Birth Day:</label><br>
            <input class="input" type="date" name="birth_day" id="date"
                value="<?php echo isset($old['birth_day'])? $old['birth_day']: $_SESSION['c_user'] ['birth_day']; ?>" placeholder="new birth date"><br>

            <label class="txt-size color margin" for="number">Phone number:</label><br>
            <input class="input" type="tel" name="number" id="number" pattern="[0-9]{11}"
                value="<?php echo isset($old['number'])? $old['number']: $_SESSION['c_user'] ['number']; ?>" placeholder="01700000000"><br>

            <label class="txt-size1 color margin" for="address" style="margin-top:50px;">Address:</label><br>
            <textarea class="inputbox" rows="3" cols="58" name="address" id="address" maxlength="180" placeholder="EX:Mirpur,Dhaka-1216...." ><?php echo isset($old['description'])? $old['description']:$_SESSION['c_user'] ['address']; ?></textarea>
        
            <label class="txt-size color margin" for="profile">Profile picture:</label><br>
            <input class="input" type="file" name="profile_pic" id="profile" placeholder="new profile picture"><br>

            <a class="a-g" href="<?php echo BASE_URL.'?page=change_password' ?>">Change Password?.</a>
            <button class="button" type="submit">Update</button><br>
        </form>

    </div>

</div>
