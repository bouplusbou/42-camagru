<h1>RESET PASSWORD</h1>

<?php if (isset($confirmation_msg)): ?>
<div class="reset_wrapper">
    <div class="form">
        <input placeholder="new password" type="password" id="new_pswd" />
        <input type="submit" value="Reset Password" id="reset_submit" />
        <?php if (isset($errors) && $errors !== ''):
            foreach ($errors as $error) {
                echo $error;
            } 
        endif; ?>
    </div>
</div>
<?php endif; ?>

<?php if (isset($error_msg)):
	echo $error_msg;
endif; ?>



<div id="message" style="color:red;"></div>

<a href="index.php?p=login">Login</a>


<script type="text/javascript">
<?php if (isset($_GET['email']) && isset($_GET['hash'])) { ?>
    let email = "<?= $_GET['email']; ?>";
    let hash = "<?= $_GET['hash']; ?>";
<?php } ?>
</script>
<script type="text/javascript" src="./app/assets/js/reset.js"></script>







<!-- // check if old password ok
// check if new password respect security -->