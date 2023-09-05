<?php
// session_start();
// require('../backEnd/msg.php');

if (empty($_SESSION['reset_email'])) {
    header("Location:../");
    exit;
}
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
    <title>Reset Password</title>
    <link rel="stylesheet" href="./css/reset_password.css">
</head>
<body>
    <div class="con">
        <div class="login">
            <h1>Reset Password</h1>
        </div>
        <div class="input">
            <form action="./backEnd/path.php" method="post"><br>

                <input type="hidden" name="action" value="reset_password">

                <label for="password">Password</label>
                <input type="password" name="password" id="password" minlength="6" maxlength="32" placeholder="New Password" required><br>

                <label for="cpassword">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" minlength="6" maxlength="32" placeholder="Confirm Password" required>

                <p>Go back to <a href="http://localhost/shop/logwork.php?logaction=forget_password">Forget Password</a>.</p>
                <p style="color:#DA0037;"><?php echo $msg.$msg2; ?> </p><br>
                <button type="submit">Change</button>
            </form>
        </div>
    </div>
    
</body>
</html>
