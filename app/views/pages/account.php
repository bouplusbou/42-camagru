<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>
<div id="notification_wrapper">
</div>

<section class="section">
  <div class="container">
    <h1 class="title">Account</h1>
  </div>
</section>

<h2>Hi <?= $_SESSION['username'] ?>,</h2>

<div class="username_cont">
    <p>Current username: <?= $_SESSION['username'] ?></p>
    <p>New username: </p>
    <input type="text" value="" id="input_username"><br>
    <p>Enter your password: </p>
    <input type="password" value="" id="input_username_password"><br>
    <div id="error_msg_username" style="color:red;"></div>
    <button id="btn_username">Change username</button>
</div>
<div class="email_cont">
    <p>Current email: <?= $_SESSION['email'] ?></p>
    <p>New email: </p>
    <input type="text" value="" id="input_email"><br>
    <p>Enter your password: </p>
    <input type="password" value="" id="input_email_password"><br>
    <div id="error_msg_email" style="color:red;"></div>
    <button id="btn_email">Change email</button>
</div>
<div class="password_cont">
    <p>Password</p>
    <p>New password: </p>
    <input type="password" value="" id="input_pswd"><br>
    <p>Current password: </p>
    <input type="password" value="" id="input_pswd_password"><br>
    <div id="error_msg_pswd" style="color:red;"></div>
    <button id="btn_pswd">Change password</button>
</div>
<div class="email_pref_cont">
    <p>Email preferences</p>
    <p>You want a notification by email when someone comments one of your posts: </p>
    <div>
        <input type="radio" id="email_pref_yes" name="email_pref_radio" value="yes" <?= $_SESSION['email_when_comment'] === '1' ? 'checked' : "" ?>>
        <label for="yes">Yes</label>
    </div>
    <div>
        <input type="radio" id="email_pref_no" name="email_pref_radio" value="no" <?= $_SESSION['email_when_comment'] === '0' ? 'checked' : "" ?>>
        <label for="no">No</label>
    </div>
    <div id="confirmation_msg_pref" style="color:green;"></div>
    <button id="btn_email_pref">Change email preferences</button>
</div>

<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/account.js"></script>