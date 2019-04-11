<?php
$errmsg = '';

?>
<script>
// function form_action(form_id) {
//     form = document.getElementById(form_id);
//     action = form.getAttribute('action');
//     controller = action.split('.')[0];
//     method = action.split('.')[1];
//     url = './app/controllers/' + controller + '.php';
//     console.log(url);
//     input = document.createElement('input');
//     input.setAttribute('type','hidden');
//     input.setAttribute('name','action');
//     input.setAttribute('value',method);
//     form.appendChild(input);
//     form.setAttribute('action', url);
//     form.submit();
// }

</script>
<h1>SIGNUP</h1>
<div class="signup_page">
    <div class="form">
        <form id="form_create_user" action="./app/controllers/UserController.php" name="action" method="post">
            <input placeholder="username" type="text" value="" name="username" />
            <input placeholder="email" type="text" value="" name="email" />
            <input placeholder="password" type="password" value="" name="pswd" />
            <input type="submit" value="create" name="submit" />
        </form>
        <?php if ($errmsg !== ''):
            echo $errmsg;
        endif; ?>
        <p>Already have an account ?</p>
        <a href="index.php?p=login">Login</a>
    </div>
</div>
