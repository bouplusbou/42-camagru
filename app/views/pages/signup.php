<h1>SIGNUP</h1>
<div class="signup_wrapper">
    <div class="form">
        <form id="form_create_user" action="index.php?p=signup" name="action" method="post">
            <input placeholder="username" type="text" value="" name="username" />
            <input placeholder="email" type="text" value="" name="email" />
            <input placeholder="password" type="password" value="" name="pswd" />
            <input type="submit" value="create" name="submit" />
        </form>
        <?php if (isset($errmsg) && $errmsg !== ''):
            echo $errmsg;
        endif; ?>
        <p>Already have an account ?</p>
        <a href="index.php?p=login">Login</a>
    </div>
</div>
