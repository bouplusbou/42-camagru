const commentBtn = document.getElementById('comment_btn');
const commentInput = document.getElementById('comment_input');
const commentCont = document.getElementById('comments_container');

commentBtn.addEventListener("click", function() {
    const action = 'action=create_comment&comment='+commentInput.value+'&id_post='+commentBtn.getAttribute('id_post')+'&id_post_creator='+commentBtn.getAttribute('id_post_creator');

    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            // document.getElementById("message").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/PostsController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
  
    const newDiv = document.createElement('div');
    const newCommenter = document.createElement('b');
    const newComment = document.createElement('p');
    newCommenter.innerText = currentUsername;
    newComment.innerText = commentInput.value;
    commentCont.appendChild(newCommenter);
    commentCont.appendChild(newComment);
    commentCont.appendChild(newDiv);
});


const likeBtn = document.getElementById('like_btn');

likeBtn.addEventListener("click", function(event) {
    const idPost = event.target.getAttribute('id_post');
    const action = 'action=create_like&id_post='+idPost;

    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            // document.getElementById("message").innerHTML = ajx.responseText;
            const showLikesArray = document.querySelector("[id_post_show_likes='"+idPost+"']");
            const likesNb = parseInt(showLikesArray.innerText, 10);
            showLikesArray.innerText = ajx.responseText === 'created' ? likesNb + 1 : likesNb - 1;
        }
    };
    ajx.open("POST", "./app/controllers/PostsController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
});
