const newInput = document.getElementById('new_pswd');
const resetSubmit = document.getElementById('reset_submit');

resetSubmit.addEventListener("click", function() {
    const action = 'action=reset_password_email&new_pswd='+newInput.value+'&email='+email+'&hash='+hash;

    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("message").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
  });