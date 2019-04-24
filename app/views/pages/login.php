<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
if (isset($confirmation_msg)) {
	echo $confirmation_msg;
}
?>
<div id="notification_wrapper">
</div>

<section class="section">
  <div class="container">
    <h1 class="title">Login</h1>
  </div>
</section>


<div class="columns">
	<div class="column is-5"></div>
	<div class="column is-2">
			<div class="field">
				<p class="control has-icons-left has-icons-right">
					<input class="input" id="input_username" type="text" placeholder="Username">
					<span class="icon is-small is-left">
						<i class="fas fa-user-alt"></i>
					</span>
				</p>
			</div>
			<div class="field">
				<p class="control has-icons-left">
					<input class="input" id="input_password" type="password" placeholder="Password">
					<span class="icon is-small is-left">
						<i class="fas fa-lock"></i>
					</span>
				</p>
			</div>
			<div class="field is-grouped is-right is-grouped-centered">
				<p class="control">
					<button id="button_login" class="button is-success">
						Login
					</button>
				</p>
			</div>
			<section class="section">
			  <div class="container">
			  </div>
			</section>
			<div class="level">
				<div class="level-item has-text-centered">
					<a id="reset_pswd" href="">Forgot your password ?</a>
				</div>
			</div>
			<div class="level">
				<div class="level-item has-text-centered">
					<p>Not a member yet ?   <a href="index.php?p=signup">Signup</a></p>
				</div>
			</div>
	</div>
	<div class="column is-5"></div>
</div>
<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/login.js"></script>