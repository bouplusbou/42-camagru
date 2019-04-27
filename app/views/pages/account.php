<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>

<section class="section">
  <div class="container">
    <h1 class="title">Account</h1>
  </div>
</section>

<div class="columns">
    <div class="column"></div>
    <div class="column is-one-quarter">
        <h3 class="title is-size-4"><span class="tag is-link is-large">Update your username</span></h3>
        <p>Current username: <b id="display_current_username"><?= $_SESSION['username'] ?></b></p>
        <div class="field">
			<p class="control has-icons-left has-icons-right">
				<input class="input" id="input_username" type="text" placeholder="New username">
				<span class="icon is-small is-left">
					<i class="fas fa-user-alt"></i>
				</span>
			</p>
		</div>
        <div class="field">
			<p class="control has-icons-left">
				<input class="input" id="input_username_password" type="password" placeholder="Password">
				<span class="icon is-small is-left">
					<i class="fas fa-lock"></i>
				</span>
			</p>
		</div>
        <div class="field is-grouped is-right is-grouped-centered">
			<p class="control">
				<button id="btn_username" class="button is-info is-outlined">
                    Change username
				</button>
			</p>
		</div>
        <section class="section">
		  <div class="container">
		  </div>
		</section>
        <h3 class="title is-size-4"><span class="tag is-warning is-large">Update your email</span></h3>
        <p>Current email: <b id="display_current_email"><?= $_SESSION['email'] ?></b></p>
        <div class="field">
			<p class="control has-icons-left has-icons-right">
				<input class="input" id="input_email" type="email" placeholder="New email">
				<span class="icon is-small is-left">
					<i class="fas fa-envelope"></i>
				</span>
			</p>
		</div>
        <div class="field">
			<p class="control has-icons-left">
				<input class="input" id="input_email_password" type="password" placeholder="Password">
				<span class="icon is-small is-left">
					<i class="fas fa-lock"></i>
				</span>
			</p>
		</div>
        <div class="field is-grouped is-right is-grouped-centered">
			<p class="control">
				<button id="btn_email" class="button is-info is-outlined">
					Change email
				</button>
			</p>
		</div>
        <section class="section">
		  <div class="container">
		  </div>
		</section>
        <h3 class="title is-size-4"> <span class="tag is-danger is-large">Update your password</span></h3>
        <div class="field">
			<p class="control has-icons-left">
				<input class="input" id="input_pswd" type="password" placeholder="New password">
				<span class="icon is-small is-left">
					<i class="fas fa-lock"></i>
				</span>
			</p>
		</div>
        <div class="field">
			<p class="control has-icons-left">
				<input class="input" id="input_pswd_password" type="password" placeholder="Current password">
				<span class="icon is-small is-left">
					<i class="fas fa-lock"></i>
				</span>
			</p>
		</div>
        <div class="field is-grouped is-right is-grouped-centered">
			<p class="control">
				<button id="btn_pswd" class="button is-info is-outlined">
					Change password
				</button>
			</p>
		</div>
        <section class="section">
		  <div class="container">
		  </div>
		</section>
        <h3 class="title is-size-4"> <span class="tag is-success is-large">Email preferences</span></h3>
        <p>Email notification for <b>new comments</b>:</p>
        <div class="control">
          <label class="radio">
            <input type="radio" id="email_pref_yes" name="answer" <?= $_SESSION['email_when_comment'] === '1' ? 'checked' : "" ?>>
            Yes
          </label>
          <label class="radio">
            <input type="radio" id="email_pref_no" name="answer" <?= $_SESSION['email_when_comment'] === '0' ? 'checked' : "" ?>>
            No
          </label>
        </div>
        <br>
        <div class="field is-grouped is-right is-grouped-centered">
			<p class="control">
				<button id="btn_email_pref" class="button is-info is-outlined">
					Change email preferences
				</button>
			</p>
		</div>
    </div>
    <div class="column"></div>
</div>


<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/account.js"></script>

