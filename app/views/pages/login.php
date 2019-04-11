<h1>LOGIN</h1>
<div class="login_wrapper">
	<div class="form">
		<form id="form_login" action="index.php?p=login" method="post">
			<input placeholder="username" type="text" value="" name="username" />
			<input placeholder="password" type="password" value="" name="pswd" />
			<input type="submit" value="login" name="submit" />
		</form>
		<!-- <?php if ($errmsg !== ''):
			echo $errmsg;
			endif; ?> -->
        <p>Not yet a member ?</p>
		<a href="index.php?p=signup">Create an account</a>
	</div>
</div>