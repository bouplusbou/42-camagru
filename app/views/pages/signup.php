<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>

<section class="section">
  <div class="container">
    <h1 class="title">Signup</h1>
  </div>
</section>

<div class="columns">
	<div class="column"></div>
	<div class="column is-one-quarter">
			<div class="field">
				<p class="control has-icons-left has-icons-right">
					<input class="input" id="input_username" type="text" placeholder="Username">
					<span class="icon is-small is-left">
						<i class="fas fa-user-alt"></i>
					</span>
				</p>
			</div>
      <div class="field">
				<p class="control has-icons-left has-icons-right">
					<input class="input" id="input_email" type="email" placeholder="Email">
					<span class="icon is-small is-left">
						<i class="fas fa-envelope"></i>
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
					<button id="button_create_account" class="button is-success">
						Create account
					</button>
				</p>
			</div>
			<section class="section">
			  <div class="container">
			  </div>
			</section>
			<div class="level">
				<div class="level-item">
					<p>Already have an account ?</p>
				</div>
			</div>
			<div class="level">
				<div class="level-item">
                    <a href="index.php?p=login">Login</a>
				</div>
			</div>
	</div>
	<div class="column"></div>
</div>
<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/signup.js"></script>