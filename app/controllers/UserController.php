<?php
var_dump($_POST);

$errors = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['submit'] === "create") {
        if (strlen($_POST['email']) === 0) {
            $errors[] = 'Please enter your email.';
        // } else if (is_valid_email($_POST['email']) == false) {
        //     $errors[] = 'Invalid email adress format.';
        // }
        // if (strlen($_POST['pswd']) === 0) {
        //     $errors[] = 'Please enter a password.';
        // }
        // if (check_user_existance($passwd_db, $_POST['email']) == true) {
        //     $errors[] = 'There is already a user registered with that email.';
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0) {
    echo "Your account is created!\n";
    echo "Redirect to galery\n";
    // header('Location: /index.php?p=login');
} else {
    // $errmsg = create_error_html($errors);
    $errmsg = 'Please enter your email.';
    header('Location: /index.php?p=signup&error=account,password');

}