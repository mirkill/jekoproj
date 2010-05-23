<div class="login">
<h2>Signin</h2>
<form method="post" id="login_form" action="">
<fieldset>
<ul>
    <li>
        <div class="error"></div>
    </li>
    <li>
        <label for="login">login</label>
        <input type="text" name="login" class="login" value="login">
    </li>
    <li>
        <label for="pwd">password</label>
        <input type="password" name="pwd" class="pwd" value="123456">
    </li>
    <li><a href="#" class="forgot_password">forgot password?</a></li>
<li>
<input type="button" title="press it" value="login" class="login_btn">
</li>
</ul>


</fieldset>
</form>
</div>
<div class="forgot" style="display: none;">
<h2>Forgot Password</h2>
<form method="post" id="forgot_form" action="">
<fieldset>
<ul>
    <li>
        <div class="error"></div>
    </li>
    <li>
        <label for="f_email">Email</label>
        <input type="text" name="f_email" class="f_email">
    </li>
    
<li>
<input type="button" title="press it for start reset password" value="send mail" class="forgot_btn">
</li>
</ul>


</fieldset>
</form>
</div>