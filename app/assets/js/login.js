
const btnLogin = document.getElementById('button_login');
const token = document.getElementById('token').value;

btnLogin.addEventListener("click", function() {
    const notificationWrapper = document.getElementById('notification_wrapper');
    const inputUsername = document.getElementById('input_username').value;
    const inputPassword = document.getElementById('input_password').value;
    const action = 'action=login&username='+inputUsername+'&password='+inputPassword+'&token='+token;
    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            console.log('coucou');
            window.location = 'index.php';
        }
        if (ajx.readyState == 4 && ajx.status == 400) {
            notificationWrapper.innerHTML = '<div class="notification is-danger"><div class="container"><p>'+ajx.responseText+'</p></div></div>';
        }
        if (ajx.readyState == 4 && ajx.status == 401) {
            notificationWrapper.innerHTML = '<div class="notification is-dark"><div class="container"><p>'+ajx.responseText+'</p></div></div>';
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
});





const resetBtn = document.getElementById('reset_pswd');

resetBtn.addEventListener("click", function() {
    let email = window.prompt("Please enter your email if you want to reset your password");

    if (email) {
        const regex = /\S+@\S+\.\S+/ ;
        if (regex.test(String(email).toLowerCase())) {
            const action = 'action=reset_password_email&email='+email+'&token='+token;

            const ajx = new XMLHttpRequest();
            ajx.onreadystatechange = function () {
                if (ajx.readyState == 4 && ajx.status == 200) {
                    document.getElementById("message").innerHTML = ajx.responseText;
                }
            };
            ajx.open("POST", "./app/controllers/UsersController.php", true);
            ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajx.send(action);
            window.alert("If the address " + email + " is related to a Camagru account, an email has been sent to reset your password");
        } else {
            window.alert("Please enter a proper email if you want to reset your password");
        }

    }
  
});