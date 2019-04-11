<?php

require './app/models/User.php';

function logout() {
    if (isset($_SESSION['username'])) {
        unset($_SESSION['username']);
        header('Location: index.php');
    }
}




function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['submit'] === "login") {
        loginAttempt($_POST);
    }
    require './app/views/pages/login.php';
}

function loginAttempt($user_cred) {
    if ($user = User::userExists($user_cred)) {
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
    } else {
        echo "Sorry wrong username or password\n";
    }
} 

function signup() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['submit'] === "create") {
        if (createUser($_POST) == false)
            exit ;
    }
    require './app/views/pages/signup.php';
}

function createUser($data) {
    if (errors($data)) {
        exit;
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    $creation_date = date("Y-m-d H:i:s");
    $user_data = array($username, $email, $pswd, '0', $creation_date);
    $user = User::insertUser($user_data);
    $user_cred = array(
        "username" => $username, 
        "pswd" => $pswd,
    );
    loginAttempt($user_cred);
}

function errors($data) {
    $errors = array();
    if ($_POST['submit'] === "create") {
        if (strlen($_POST['email']) === 0) {
            $errors[] = 'Please enter your email.';
        }
    }
    if (count($errors) !== 0) {
        echo "Error\n";
        $errmsg = 'Please enter your email.';
        require './app/views/pages/signup.php';
        return true;
    } else {
        return false;
    }
}



