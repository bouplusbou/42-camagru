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

<!-- <div class="field">
  <label class="label">Email</label>
  <div class="control has-icons-left has-icons-right">
    <input class="input is-danger" type="email" placeholder="Email input" value="hello@">
    <span class="icon is-small is-left">
      <i class="fas fa-envelope"></i>
    </span>
    <span class="icon is-small is-right">
      <i class="fas fa-exclamation-triangle"></i>
    </span>
  </div>
  <p class="help is-danger">This email is invalid</p>
</div> -->



<!-- <div class="signup_wrapper">
    <div class="form">
        <form id="form_create_user" action="index.php?p=signup" name="action" method="post">
            <input placeholder="username" type="text" value="" name="username" />
            <input placeholder="email" type="text" value="" name="email" />
            <input placeholder="password" type="password" value="" name="pswd" />
            <input type="submit" value="create" name="submit" />
            <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
        </form>
        <?php if (isset($errors) && $errors !== ''):
            foreach ($errors as $error) {
                echo $error;
            } 
        endif; ?>
        <p>Already have an account ?</p>
        <a href="index.php?p=login">Login</a>
    </div>
</div> -->
