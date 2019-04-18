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

btnUsername.addEventListener("click", function() {
    let usernameInfo = 'newUsername='+inputUsername.value+'&pswd='+inputUsernamePassword.value+'&username='+username;

    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("error_msg_username").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(usernameInfo);
});

btnEmail.addEventListener("click", function() {
    let emailInfo = 'newEmail='+inputEmail.value+'&pswd='+inputEmailPassword.value+'&username='+username;

    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("error_msg_email").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(emailInfo);
});

btnPswd.addEventListener("click", function() {
    let pswdInfo = 'newPassword='+inputPswd.value+'&currentPswd='+inputPswdPassword.value+'&email='+email+'&username='+username;

    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("error_msg_pswd").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(pswdInfo);
});

btnEmailPref.addEventListener("click", function() {
    let emailPref = '0';
    if (radioPrefYes.checked) {
        emailPref = '1';
    }
    let emailPrefInfo = 'action=update_email_pref&email_pref='+emailPref+'&username='+username;

    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("confirmation_msg_pref").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(emailPrefInfo);
});