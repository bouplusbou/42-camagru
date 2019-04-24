
const btnCreateAccount = document.getElementById('button_create_account');
const token = document.getElementById('token').value;

btnCreateAccount.addEventListener("click", function() {
    document.querySelectorAll('.help').forEach(function(a){
        a.remove()
    })
    const notificationWrapper = document.getElementById('notification_wrapper');
    notificationWrapper.innerHTML = "";
    const inputUsername = document.getElementById('input_username');
    const inputEmail = document.getElementById('input_email');
    const inputPassword = document.getElementById('input_password');
    const inputUsernameValue = inputUsername.value;
    const inputEmailValue = inputEmail.value;
    const inputPasswordValue = inputPassword.value;
    const action = 'action=signup&username='+inputUsernameValue+'&email='+inputEmailValue+'&password='+inputPasswordValue+'&token='+token;
    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            window.location = 'index.php?p=login';
        }
        if (ajx.readyState == 4 && ajx.status == 400) {
            let json = JSON.parse(ajx.responseText);
            console.log(json);
            if (json.username_format) {
                inputUsername.className = "input is-danger";
                let helper = document.createElement('p');
                helper.className = "help is-danger";
                helper.innerText = json.username_format;
                inputUsername.after(helper);
            } else {
                inputUsername.className = "input is-success";
            }
            if (json.email_invalid) {
                inputEmail.className = "input is-danger";
                let helper = document.createElement('p');
                helper.className = "help is-danger";
                helper.innerText = json.email_invalid;
                inputEmail.after(helper);
            } else {
                inputEmail.className = "input is-success";
            }
            if (json.password_format) {
                inputPassword.className = "input is-danger";
                let helper = document.createElement('p');
                helper.className = "help is-danger";
                helper.innerText = json.password_format;
                inputPassword.after(helper);
            } else {
                inputPassword.className = "input is-success";
            }
            if (json.username_or_email_exist) {
                inputUsername.className = "input is-danger";
                inputEmail.className = "input is-danger";
                notificationWrapper.innerHTML = '<div class="notification is-danger"><div class="container"><p>'+json.username_or_email_exist+'</p></div></div>';
            }
        }
        if (ajx.readyState == 4 && ajx.status == 401) {
            notificationWrapper.innerHTML = '<div class="notification is-dark"><div class="container"><p>'+ajx.responseText+'</p></div></div>';
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
});
