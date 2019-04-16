const commentBtn = document.getElementById('comment_btn');
const commentInput = document.getElementById('comment_input');
const commentCont = document.getElementById('comments_container');

commentBtn.addEventListener("click", function() {
    let commentInfo = 'comment='+commentInput.value+'&id_user='+currentUserID+'&id_post='+commentBtn.getAttribute('id_post');

    // console.log(commentInfo);

    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            document.getElementById("message").innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "./app/controllers/CommentsController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(commentInfo);
  
    let newDiv = document.createElement('div');
    let newCommenter = document.createElement('b');
    let newComment = document.createElement('p');
    newCommenter.innerText = currentUsername;
    newComment.innerText = commentInput.value;
    commentCont.appendChild(newCommenter);
    commentCont.appendChild(newComment);
    commentCont.appendChild(newDiv);
});