const resetBtn = document.getElementById('reset_pswd');

resetBtn.addEventListener("click", function() {
    let email = window.prompt("Please enter your email if you want to reset your password");

    if (email) {
        const regex = /\S+@\S+\.\S+/ ;
        if (regex.test(String(email).toLowerCase())) {
            let resetInfo = 'resetEmail='+email;

            var ajx = new XMLHttpRequest();
            ajx.onreadystatechange = function () {
                if (ajx.readyState == 4 && ajx.status == 200) {
                    document.getElementById("message").innerHTML = ajx.responseText;
                }
            };
            ajx.open("POST", "./app/controllers/UsersController.php", true);
            ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajx.send(resetInfo);
            window.alert("An email has been sent to " + email + " to reset your password");
        } else {
            window.alert("Please enter a proper email if you want to reset your password");
        }

    }
  
});