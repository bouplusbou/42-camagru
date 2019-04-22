const btnUsername = document.getElementById('btn_username');
const btnEmail = document.getElementById('btn_email');
const btnPswd = document.getElementById('btn_pswd');
const btnEmailPref = document.getElementById('btn_email_pref');

const inputUsername = document.getElementById('input_username');
const inputEmail = document.getElementById('input_email');
const inputPswd = document.getElementById('input_pswd');
const inputEmailPassword = document.getElementById('input_email_password');
const inputUsernamePassword = document.getElementById('input_username_password');
const inputPswdPassword = document.getElementById('input_pswd_password');
const radioPrefYes = document.getElementById('email_pref_yes');

const token = document.getElementById('token').value;

btnUsername.addEventListener("click", function() {
    const action = 'action=update_username&newUsername='+inputUsername.value+'&pswd='+inputUsernamePassword.value+'&token='+token;

    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("error_msg_username").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
});

btnEmail.addEventListener("click", function() {
    const action = 'action=update_email&newEmail='+inputEmail.value+'&pswd='+inputEmailPassword.value+'&token='+token;

    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("error_msg_email").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
});

btnPswd.addEventListener("click", function() {
    const action = 'action=update_password&newPassword='+inputPswd.value+'&currentPswd='+inputPswdPassword.value+'&token='+token;

    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("error_msg_pswd").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
});

btnEmailPref.addEventListener("click", function() {
    let emailPref = '0';
    if (radioPrefYes.checked) {
        emailPref = '1';
    }
    const action = 'action=update_email_pref&email_pref='+emailPref+'&token='+token;

    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("confirmation_msg_pref").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
});