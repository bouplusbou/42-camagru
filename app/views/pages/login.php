<h1>LOGIN</h1>
<?php if (isset($confirmation_msg)):
			echo $confirmation_msg;
endif; ?>
<div class="login_wrapper">
	<div class="form">
		<form id="form_login" action="index.php?p=login" method="post">
			<input placeholder="username" type="text" value="" name="username" />
			<input placeholder="password" type="password" value="" name="pswd" />
			<input type="submit" value="login" name="submit" />
		</form>
		<?php if (isset($error_msg)):
			echo $error_msg;
		endif; ?>
		<p>Forgot your password ?</p>
		<button id="reset_pswd">Reset password</button>
        <p>Not yet a member ?</p>
		<a href="index.php?p=signup">Create an account</a>
	</div>
</div>


<script type="text/javascript" src="./app/assets/js/login.js"></script>