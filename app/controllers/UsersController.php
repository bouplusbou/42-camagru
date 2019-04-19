<?php

require_once __DIR__.'/../models/User.php';



/////////// Views ///////////


function view_signup() {
    if (isset($_POST['submit']) && $_POST['submit'] === "create") {
        create_user();
    }
    require_once './app/views/pages/signup.php';
}


function view_login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['submit'] === "login") {
        if ($user = User::userCredsOK($_POST)) {
            if ($user['confirmed'] === '1') {
                $_SESSION['username'] = $user['username'];
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['email_when_comment'] = $user['email_when_comment'];
                header('Location: index.php');
            } else {
                $error_msg = "Sorry but you have to confirm your email address first";
            }
        } else {
            $error_msg = "Sorry wrong username or password";
        }
    }
    require_once './app/views/pages/login.php';
}


function view_logout() {
    if (isset($_SESSION['username'])) {
        unset($_SESSION['username']);
    }
    if (isset($_SESSION['id_user'])) {
        unset($_SESSION['id_user']);
    }
    if (isset($_SESSION['email'])) {
        unset($_SESSION['email']);
    }
    if (isset($_SESSION['email_when_comment'])) {
        unset($_SESSION['email_when_comment']);
    }
    header('Location: index.php');
}


function view_account() {
    if (isset($_SESSION['username'])) {
        require_once __DIR__.'/../views/pages/account.php';
    } else {
        header('HTTP/1.0 403 Forbidden');
        echo 'You are forbidden!';
        exit;
    }
}


function view_confirmation($email, $hash) {
    if (User::userConfirmed($email, $hash)) {
        $_SESSION['user_confirmed'] = '1';
        $confirmation_msg = "Congratulations ! You've just confirmed your account. Enter your credentials to connect";
    } else {
        $error_msg = "Sorry but the link you used to confirmed your email is obsolete, please try to signup again.";
    }
    require_once './app/views/pages/login.php';
}


function view_reset_email($email, $hash) {
    if (User::emailHashMatch($email, $hash)) {
        $confirmation_msg = "The link is OK";
    } else {
        $error_msg = "Sorry but the link you used to confirmed your email is obsolete, please try to reset your password again.";
    }
    require_once __DIR__.'/../views/pages/reset_password.php';
}





/////////// Check errors ///////////


function submit_errors() {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['pswd'];
    $errors = array();
    if (!preg_match("/^[A-Za-z0-9]{3,10}$/", $username)) {
        $errors[] = 'Please enter a username between 3 and 10 characters containing only numbers and letters.';
    }
    if (User::usernameExists($username)) {
        $errors[] = 'This username or this email already exists.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a proper email address.';
    }
    if (User::emailExists($email)) {
        $errors[] = 'This username or this email already exists.';
    }
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/", $password)) {
        $errors[] = 'Please enter a password at least 6 characters long containing at least one upper letter, one lower letter and one number.';
    }
    if (count($errors) !== 0) {
        require_once './app/views/pages/signup.php';
        return true;
    } else {
        return false;
    }
}


function reset_errors() {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['pswd'];
    $errors = array();
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/", $password)) {
        $errors[] = 'Please enter a password at least 6 characters long containing at least one upper letter, one lower letter and one number.';
    }
    return false;
}




/////////// CRUD ///////////


function create_user() {
    if (submit_errors()) {
        exit;
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pswd = password_hash($_POST['pswd'], PASSWORD_BCRYPT);
    $verif_hash = md5(uniqid(rand(), true));
    $creation_date = date("Y-m-d H:i:s");
    $user_data = array($username, $email, $pswd, $verif_hash, '0', '1', $creation_date);
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


// Update email preferences
if (isset($_POST['action']) && $_POST['action'] === 'update_email_pref') {
    session_start();
    User::updateEmailPref($_POST['username'], $_POST['email_pref']);
    $_SESSION['email_when_comment'] = $_POST['email_pref'];
    echo "email preferences updated";
}


// Update username
if (isset($_POST['newUsername']) && isset($_POST['pswd']) && isset($_POST['username'])) {
    session_start();
    $pswd = $_POST['pswd'];
    $new_username = $_POST['newUsername'];
    $current_username = $_POST['username'];
    if (User::pswdUsernameMatch($pswd, $current_username)) {
        if (!preg_match("/^[A-Za-z0-9]{3,10}$/", $new_username)) {
            echo 'Please enter a username between 3 and 10 characters containing only numbers and letters.';
            exit;
        } else if (User::usernameExists($new_username)) {
            echo 'This username is already taken.';
        } else {
            User::updateUsername($current_username, $new_username);
            $_SESSION['username'] = $new_username;
            echo "Username changed";
        }
    } else {
        echo "password KO";
    }
}


// Update email
if (isset($_POST['newEmail']) && isset($_POST['pswd']) && isset($_POST['username'])) {
    session_start();
    $pswd = $_POST['pswd'];
    $new_email = $_POST['newEmail'];
    $username = $_POST['username'];
    if (User::pswdUsernameMatch($pswd, $username)) {
        if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            echo 'Please enter a proper email address.';
        }
        else if (User::emailExists($new_email)) {
            echo 'This email already exists.';
        } else {
            User::updateEmail($username, $new_email);
            $_SESSION['email'] = $new_email;
            echo "Email changed";
        }
    } else {
        echo "password KO";
    }
}


// Update password via account
if (isset($_POST['newPassword']) && isset($_POST['currentPswd']) && isset($_POST['email']) && isset($_POST['username'])) {
    session_start();
    $current_pswd = $_POST['currentPswd'];
    $new_pswd = $_POST['newPassword'];
    $hashed_pswd = password_hash($new_pswd, PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $username = $_POST['username'];
    if (User::pswdUsernameMatch($current_pswd, $username)) {
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/", $new_pswd)) {
            echo 'Please enter a password at least 6 characters long containing at least one upper letter, one lower letter and one number.';
        } else {
            User::updatePswd($email, $hashed_pswd);
            echo "Password changed";
        }
    } else {
        echo "password KO";
    }
}


// Update password via reset password email
if (isset($_POST['newPswd']) && isset($_POST['email']) && isset($_POST['hash'])) {
    $new_pswd = $_POST['newPswd'];
    $hashed_pswd = password_hash($new_pswd, PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $hash = $_POST['hash'];
    if (User::emailHashMatch($email, $hash)) {
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/", $new_pswd)) {
            echo 'Please enter a password at least 6 characters long containing at least one upper letter, one lower letter and one number.';
        } else {
            User::updatePswd($email, $hashed_pswd);
            echo "password changed";
            echo '<a href="index.php?p=login">Login</a>';
            exit;
        }
    } else {
        echo "email doesnt match";
    }

}


// send reset password
if (isset($_POST['resetEmail'])) {
    $email = $_POST['resetEmail'];
    if ($verif_hash = User::emailExists($email)) {
        $subject = 'Reset your password';
        $message = '
    
        Hi,
        We\'ve just received  a request to reset your password. If you didn\'t make the request, just ignore this email.
        Otherwise you can reset your password using this link:

        http://127.0.0.1:8080/index.php?p=resetEmail&email='.$email.'&hash='.$verif_hash['verif_hash'].'
    
        Thanks,
        The Camagru Team
        ';
        echo 'http://127.0.0.1:8080/index.php?p=resetEmail&email='.$email.'&hash='.$verif_hash['verif_hash'];
        mail($email, $subject, $message);
    }
}
