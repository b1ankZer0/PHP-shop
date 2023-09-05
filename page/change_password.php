</pre>
<h1 class="center">Change Password</h1><hr>
<div class=" flax bg-color1" style="width:100%; height: 500px; padding:auto; border:1px solid #B2B1B9;">
    <div class='' style="width:48%; height:100%; margin:auto; text-align: laft; justify-content: laft;">
        <form action="http://localhost/shop/" method="post" enctype="multipart/form-data" class="pad" style="margin-left: 20%;">
            <input type="hidden" name="action" value="change_password"><br><br><br><br>
        <label class="txt-size1 color margin" for="old_password">Old Password:</label><br><br>
        <input class="input" type="password" name="old_password" id="old_password" minlength="6" maxlength="32" placeholder="Old Password..." required><br><br>

        <label class="txt-size1 color margin" for="new_password">New Password:</label><br><br>
        <input class="input" type="password" name="new_password" id="new_password"  minlength="6" maxlength="32" placeholder="New Password..." required><br><br>

        <label class="txt-size1 color margin" for="confirm_password">Confirm Password:</label><br><br>
        <input class="input" type="password" name="confirm_password" id="confirm_password"  minlength="6" maxlength="32" placeholder="Confirm Password..." required><br><br>

    </div>
</div>
<div class='center' style="width:50%; height:120px; margin:auto; padding:30px;">
        <button class="button" type="submit" style="margin-top:20px; margin-left: 0px;">Change</button>
        </form>
</div>
