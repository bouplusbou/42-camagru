const likeBtnArray = document.getElementsByClassName('like_btn');
for (var i = 0; i < likeBtnArray.length; i++) {
    likeBtnArray[i].addEventListener("click", function(event) {
        const idPost = event.target.getAttribute('id_post');
        const action = 'action=create_like&id_user='+currentUserID+'&id_post='+idPost;
    
        const ajx = new XMLHttpRequest();
        ajx.onreadystatechange = function () {
            if (ajx.readyState == 4 && ajx.status == 200) {
                // document.getElementById("message").innerHTML = ajx.responseText;
                const showLikesArray = document.querySelector("[id_post_show_likes='"+idPost+"']");
                let likesNb = parseInt(showLikesArray.innerText, 10);
                showLikesArray.innerText = ajx.responseText === 'created' ? likesNb + 1 : likesNb - 1;
            }
        };
        ajx.open("POST", "./app/controllers/PostsController.php", true);
        ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajx.send(action);
    });
};
