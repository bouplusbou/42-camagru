<?php
$errmsg = '';
$errors = array();
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     if ($_POST['submit'] !== "Create") {
//         $errors[] = 'Invalid submit value';
//     }
//     if (strlen($_POST['email']) === 0) {
//         $errors[] = 'Please enter your email.';
//     } else if (is_valid_email($_POST['email']) == false) {
//         $errors[] = 'Invalid email adress format.';
//     }
//     if (strlen($_POST['pswd']) === 0) {
//         $errors[] = 'Please enter a password.';
//     }
    // if (check_user_existance($passwd_db, $_POST['email']) == true) {
    //     $errors[] = 'There is already a user registered with that email.';
    // }
// }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0) {

    





    header('Location: login.php');
} else {
    $errmsg = create_error_html($errors);
}
?>
<h1>SIGNUP</h1>
<div class="login-page">
    <div class="form">
        <form id="signup_form" action="signup.php" method="post">
            <input placeholder="username" type="text" value="" name="username" />
            <input placeholder="email" type="text" value="" name="email" />
            <input placeholder="password" type="password" value="" name="pswd" />
            <input type="submit" value="Create" name="submit" />
        </form>
        <?php if ($errmsg !== ''):
            echo $errmsg;
        endif; ?>
        <a href="login.php">Sign In</a>
    </div>
</div>
