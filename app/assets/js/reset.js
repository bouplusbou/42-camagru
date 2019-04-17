const newInput = document.getElementById('new_pswd');
const resetSubmit = document.getElementById('reset_submit');

resetSubmit.addEventListener("click", function() {
    let resetInfo = 'newPswd='+newInput.value+'&email='+email+'&hash='+hash;

    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("message").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/UsersController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(resetInfo);
  });