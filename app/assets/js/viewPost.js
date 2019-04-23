const commentBtn = document.getElementById('comment_btn');
const commentInput = document.getElementById('comment_input');
const commentCont = document.getElementById('comments_container');
const token = document.getElementById('token').value;

commentBtn.addEventListener("click", function() {
    // console.log(token);
    const action = 'action=create_comment&comment='+commentInput.value+'&id_post='+commentBtn.getAttribute('id_post')+'&id_post_creator='+commentBtn.getAttribute('id_post_creator')+'&token='+token;

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
    newDiv.className = 'level-left';
    newDiv.innerHTML = '<p><b>'+currentUsername+'</b>   '+commentInput.value+'</p>'
    commentCont.appendChild(newDiv);
});


const likeBtn = document.getElementById('like_btn');

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
        }
    };
    ajx.open("POST", "./app/controllers/PostsController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
});
