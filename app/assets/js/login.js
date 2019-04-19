const resetBtn = document.getElementById('reset_pswd');

resetBtn.addEventListener("click", function() {
    let email = window.prompt("Please enter your email if you want to reset your password");

    if (email) {
        const regex = /\S+@\S+\.\S+/ ;
        if (regex.test(String(email).toLowerCase())) {
            const action = 'action=reset_password_email&email='+email;

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