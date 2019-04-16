const likeBtnArray = document.getElementsByClassName('like_btn');
for (var i = 0; i < likeBtnArray.length; i++) {
    likeBtnArray[i].addEventListener("click", function(event) {
        let idPost = event.target.getAttribute('id_post');
        let likeInfo = 'action=create_like&id_user='+currentUserID+'&id_post='+idPost;
    
        var ajx = new XMLHttpRequest();
        ajx.onreadystatechange = function () {
            if (ajx.readyState == 4 && ajx.status == 200) {
                document.getElementById("message").innerHTML = ajx.responseText;
            }
        };
        ajx.open("POST", "./app/controllers/PostsController.php", true);
        ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajx.send(likeInfo);
        
        const showLikesArray = document.querySelector("[id_post_show_likes='"+idPost+"']");
        let likesNb = parseInt(showLikesArray.innerText, 10);
        showLikesArray.innerText = likesNb + 1;

    });
};
