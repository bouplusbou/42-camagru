const commentBtn = document.getElementById('comment_btn');
const commentInput = document.getElementById('comment_input');
const commentCont = document.getElementById('comments_container');
const likeBtn = document.getElementById('like_btn');

const token = document.getElementById('token').value;

commentBtn.addEventListener("click", function() {
    const action = 'action=create_comment&comment='+commentInput.value+'&id_post='+commentBtn.getAttribute('id_post')+'&id_post_creator='+commentBtn.getAttribute('id_post_creator')+'&token='+token;

    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            // document.getElementById("message").innerHTML = ajx.responseText;
        }
        if (ajx.readyState == 4 && ajx.status == 401) {
            createNotificationWrapper(ajx.responseText, 'is-dark');
        }
    };
    ajx.open("POST", "./app/controllers/PostsController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
  
    const newDiv = document.createElement('div');
    newDiv.className = 'level-left';
    newDiv.innerHTML = '<p><b>'+currentUsername+'</b>   '+commentInput.value+'</p>'
    commentCont.appendChild(newDiv);
});

likeBtn.addEventListener("click", function(event) {
    const idPost = event.target.getAttribute('id_post');
    const action = 'action=create_like&id_post='+idPost+'&token='+token;

    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            // document.getElementById("message").innerHTML = ajx.responseText;
            const showLikesArray = document.querySelector("[id_post_show_likes='"+idPost+"']");
            const likesNb = parseInt(showLikesArray.innerText, 10);
            showLikesArray.innerText = ajx.responseText === 'created' ? likesNb + 1 : likesNb - 1;
            likeBtn.className = ajx.responseText === 'created' ? 'like_btn fas fa-heart fa-lg' : 'like_btn far fa-heart fa-lg';
        }
    };
    ajx.open("POST", "./app/controllers/PostsController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
});



/////////////////// NOTIFICATIONS ///////////////////

function createNotificationWrapper(responseText, type) {
    notificationWrapper = document.createElement('div');
    notificationWrapper.setAttribute('id', 'notification_wrapper');
    notificationWrapper.setAttribute('style', 'position:fixed;top:20px;width:100%;z-index:100;visibility:visible;animation:cssAnimation 0s 3s forwards;');
    notificationWrapper.innerHTML = '<div class="notification '+type+'"><div class="container"><p>'+responseText+'</p></div></div>';
    navbar.after(notificationWrapper);
}