<?php
// require('./backEnd/msg.php');
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
    <title>log in</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="con">
        <div class="login">
            <h1>LOGIN</h1>
        </div>
        <div class="input">
            <form action="./backEnd/path.php" method="post"><br>

                <input type="hidden" name="action" value="login">

                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" placeholder="exampal@test.com" value="<?php echo isset($old['email'])? $old['email']:''; ?>" required><br>

                <label for="password">PASSWORD</label> 
                <input type="PASSWORD" id="password" name="password" minlength="6" maxlength="32" placeholder="Your Password " required>

                <p><a href="http://localhost/shop/logwork.php?logaction=forget_password">forget password?</a>.</p>
                <p style="color:#DA0037;"><?php echo $msg.$msg2; ?> </p>
                
                <button type="submit">LOGIN</button>
                <p>If you don't have a account, then <a href="http://localhost/shop/logwork.php?logaction=reg">SIGNUP</a>.</p>

            </form>
        </div>
    </div>
    
</body>
</html>