<h1>Account</h1>

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
<div class="password cont">
    <p>Password</p>
    <p>New password: </p>
    <input type="password" value="" id="input_pswd"><br>
    <p>Current password: </p>
    <input type="password" value="" id="input_pswd_password"><br>
    <div id="error_msg_pswd" style="color:red;"></div>
    <button id="btn_pswd">Change password</button>
</div>

<script type="text/javascript">
<?php if (isset($_SESSION['username'])) { ?>
    let username = "<?= $_SESSION['username']; ?>";
    let email = "<?= $_SESSION['email']; ?>";
<?php } ?>
</script>
<script type="text/javascript" src="./app/assets/js/account.js"></script>