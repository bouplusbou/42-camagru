<?php

require './app/models/User.php';

if (isset($_POST['emailReset'])) {
    require __DIR__.'/../models/User.php';
    $email = $_POST['emailReset'];
    if ($verif_hash = User::emailExists($email)) {
        $subject = 'Reset your password';
        $message = '
    
        Hi,
        We\'ve just received  a request to reset your password. If you did\'t make the request, just ignore this email.
        Otherwise you can reset your password using this link:

        http://127.0.0.1:8080/index.php?p=resetEmail&email='.$email.'&hash='.$verif_hash.'
    
        Thanks,
        The Camagru Team
        ';
        mail($user_data[1], $subject, $message);
    } else {

    }
}

function logout() {
    if (isset($_SESSION['username'])) {
        unset($_SESSION['username']);
        header('Location: index.php');
    }
}

function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['submit'] === "login") {
        $error_msg = login_attempt($_POST);
    }
    require './app/views/pages/login.php';
}

function login_attempt($user_cred) {
    if ($user = User::userCredsOK($user_cred)) {
        if ($user['confirmed'] === '1') {
            $_SESSION['username'] = $user['username'];
            $_SESSION['id_user'] = $user['id_user'];
            header('Location: index.php');
        } else {
            return "Sorry but you have to confirm your email address first";
        }
    } else {
        return "Sorry wrong username or password";
    }
} 

function signup() {
    if (isset($_POST['submit']) && $_POST['submit'] === "create") {
        create_user();
    }
    require './app/views/pages/signup.php';
}

function create_user() {
    if (submit_errors()) {
        exit;
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pswd = password_hash($_POST['pswd'], PASSWORD_BCRYPT);
    $verif_hash = md5(uniqid(rand(), true));
    $creation_date = date("Y-m-d H:i:s");
    $user_data = array($username, $email, $pswd, $verif_hash, '0', $creation_date);
    $user = User::insertUser($user_data);
    $user_cred = array(
        "username" => $username, 
        "pswd" => $pswd,
    );
    $subject = 'Welcome aboard !';
    $message = '

    Thanks for signing up!
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

    ------------------------
    Username: '.$user_data[0].'
    ------------------------

    Please click this link to activate your account:
    http://127.0.0.1:8080/index.php?p=confirmation&email='.$user_data[1].'&hash='.$user_data[3].'

    ';
    mail($user_data[1], $subject, $message);
    header('Location: index.php?p=login');
}

function submit_errors() {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['pswd'];
    $errors = array();
    if (strlen($username) === 0) {
        $errors[] = 'Please enter a username.';
    }
    if (!preg_match("/^[A-Za-z0-9]{3,10}$/", $username)) {
        $errors[] = 'Please enter a username between 3 and 10 characters containing only numbers and letters.';
    }
    if (User::usernameExists($username)) {
        $errors[] = 'This username or this email already exists.';
    }
    if (strlen($email) === 0) {
        $errors[] = 'Please enter your email.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a proper email address.';
    }
    if (User::emailExists($email)) {
        $errors[] = 'This username or this email already exists.';
    }
    if (strlen($password) === 0) {
        $errors[] = 'Please enter a password.';
    }
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/", $password)) {
        $errors[] = 'Please enter a password at least 6 characters long containing at least one upper letter, one lower letter and one number.';
    }
    if (count($errors) !== 0) {
        require './app/views/pages/signup.php';
        return true;
    } else {
        return false;
    }
}


// <!-- 
// // check if username not null
// // check if username contains only letter and number
// // check if username doesn't exist

// // check if email not null
// // check if email is an email address
// // check if email doesn't exist 

// // check if password not null
// // check if password is at least 6 char long and contain one maj and one number -->

function confirmation($email, $hash) {
    if (User::userConfirmed($email, $hash)) {
        $_SESSION['user_confirmed'] = '1';
        $confirmation_msg = "Congratulations ! You've just confirmed your account. Enter your credentials to connect";
    } else {
        $error_msg = "Sorry but the link you used to confirmed your email is obsolete, please try to signup again.";
    }
    require './app/views/pages/login.php';
}
