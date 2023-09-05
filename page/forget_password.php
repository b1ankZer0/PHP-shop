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
    <title>Forget Password</title>
    <link rel="stylesheet" href="./css/forget_password.css">
</head>
<body>
    <div class="con">
        <div class="login">
            <h1>Forget Password</h1>
        </div>
        <div class="input">
            <form action="./backEnd/path.php" method="post"><br>

                <input type="hidden" name="action" value="forget_password">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="exampal@test.com" required><br>

                <label for="birth_day">Birth Day</label>
                <input type="date" name="birth_day" id="birth_day" required>
                
                <p>Go back to <a href="http://localhost/shop/logwork.php?logaction=login">login</a>.</p>
                <p style="color:#DA0037;"><?php echo $msg.$msg2; ?> </p><br>
                <button type="submit">Next</button>


            </form>
        </div>
    </div>
    
</body>
</html>
