<?php
// require('../backEnd/msg.php');
// $v_error = isset($_SESSION['v_error']) ? $_SESSION['v_error'] : "";
// $msg2 = !empty($v_error) ? $v_error : "";
// $msg2= !empty($v_error) ? $v_error : "";
// unset($_SESSION['v_error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
    <link rel="stylesheet" href="./css/reg.css">
</head>
<body>
    <div class="con">

        <div class="signup">
            <h1>SIGNUP</h1>
        </div>

        <div class="input">
            <form  action="./backEnd/path.php" method="post" enctype="multipart/form-data"><br>
                <input type="hidden" name="action" value="reg">
                <div class="divl">
                    <label class="in" for="fname">FAST NAME</label> 
                    <input type="text" id="fname" name="fast_name" class="input_box" maxlength="22" placeholder="Fast Name" value="<?php echo isset($old['fast_name'])? $old['fast_name']:''; ?>" required>

                    <label class="in" for="lname">LAST NAME</label> 
                    <input type="text" id="lname" name="last_name" class="input_box" maxlength="11" placeholder="Last Name" value="<?php echo isset($old['last_name'])? $old['last_name']:''; ?>" required>

                    <label class="in" for="email">EMAIL</label>
                    <input type="email" id="email" name="email" class="input_box" placeholder="exampal@test.com" value="<?php echo isset($old['email'])? $old['email']:''; ?>" required>

                    <label class="in" for="date">BIRTH DAY</label> 
                    <input type="date" id="date"  name="birth_day" class="input_box" value="<?php echo isset($old['birth_day'])? $old['birth_day']:''; ?>" required>
                </div>

                <div class="divr">
                    <input type="file" id="file" name="profile_pic" class="file">
                    <label for="file" class="file">Profile picture</label>

                    <label class="in" for="" class="radio">GENDER</label>
                    <label for="" class="radio">
                        <input type="radio" id="male" class="gender"  name="gender" value="Male" <?php echo isset($old['gender']) && $old['gender'] == 'Male'? 'checked':'';?> required> 
                        <label class="ro" for="male">MALE</label>

                        <input type="radio" id="female" class="gender" name="gender" value="Female" <?php echo isset($old['gender']) && $old['gender'] == 'Female'? 'checked':'';?> required>
                        <label class="ro" for="female">FEMALE </label>

                        <input type="radio" id="others" class="gender" name="gender" value="Others" <?php echo isset($old['gender']) && $old['gender'] == 'Others'? 'checked':'';?> required>
                        <label class="ro" for="others">OTHERS</label>

                    </label>

                    <label class="in" for="pass">PASSWORD</label>
                    <input type="PASSWORD" id="pass" name="password" class="input_box" minlength="6" maxlength="32" placeholder="min lenth 6" required>

                    <label class="in" for="cpass">CONFIRM</label>
                    <input type="PASSWORD" id="cpass" name="cpassword" class="input_box" minlength="6" maxlength="32" placeholder="Confirm Password" required>
                    
                </div>

                <div class="divd">
                    <p>If you have a account, then <a href="http://localhost/shop/logwork.php?logaction=login">LOGIN</a>.</p>
                    <p style="color:#DA0037;"><?php echo $msg.$msg2; ?> </p>
                    <button type="submit">SIGNUP</button>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>