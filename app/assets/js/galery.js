const token = document.getElementById('token').value;

document.addEventListener('click', function (event) {

	if (event.target.matches('.like_btn')) {
		    const idPost = event.target.getAttribute('id_post');
            const action = 'action=create_like&id_post='+idPost+'&token='+token;
        
            const ajx = new XMLHttpRequest();
            ajx.onreadystatechange = function () {
                if (ajx.readyState == 4 && ajx.status == 200) {
                    const showLikesArray = document.querySelector("[id_post_show_likes='"+idPost+"']");
                    let likesNb = parseInt(showLikesArray.innerText, 10);
                    showLikesArray.innerText = ajx.responseText === 'created' ? likesNb + 1 : likesNb - 1;
                    event.target.className = ajx.responseText === 'created' ? 'like_btn fas fa-heart fa-lg' : 'like_btn far fa-heart fa-lg';
                }
                if (ajx.readyState == 4 && ajx.status == 400) {
                    createNotificationWrapper(ajx.responseText, 'is-danger');
                }
                if (ajx.readyState == 4 && ajx.status == 401) {
                    createNotificationWrapper(ajx.responseText, 'is-dark');
                }
            };
            ajx.open("POST", "./app/controllers/PostsController.php", true);
            ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajx.send(action);
    }
    if (event.target.matches('.comment_btn')) {
        let idPost = event.target.getAttribute('id_post');
        let comment = document.querySelector("[input_id_post='"+idPost+"']");
        if (!comment) {
            createNotificationWrapper('⚠️ This post does not exist', 'is-danger');
            return;
        }
        const action = 'action=create_comment&comment='+comment.value+'&id_post='+idPost+'&token='+token;
        const ajx = new XMLHttpRequest();
        ajx.onreadystatechange = function () {
            if (ajx.readyState == 4 && ajx.status == 200) {
                window.location = 'index.php?p=view_post&id='+idPost;
            }
            if (ajx.readyState == 4 && ajx.status == 400) {
                createNotificationWrapper(ajx.responseText, 'is-danger');
            }
            if (ajx.readyState == 4 && ajx.status == 401) {
                createNotificationWrapper(ajx.responseText, 'is-dark');
            }
        };
        ajx.open("POST", "./app/controllers/PostsController.php", true);
        ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajx.send(action);
          }
}, false);




window.onscroll = function(event) {
    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
        const matches = document.querySelectorAll("[offset]");
        const last = matches[matches.length -1];
        let offset = parseInt(last.getAttribute('offset'), 10);
        const action = 'action=get_next_five_posts&offset='+offset+'&token='+token;
        const ajx = new XMLHttpRequest();
        ajx.onreadystatechange = function () {
            if (ajx.readyState == 4 && ajx.status == 200) {
                let json = JSON.parse(ajx.responseText);
                let connected = json['connected'];
                delete json.connected;
                const keys = Object.keys(json)
                for (const key of keys) {
                    offset += 1;
                    let username = json[key].username;
                    let photo_name = json[key].photo_name;
                    let comment = json[key].comment;
                    let commenter = json[key].commenter;
                    let id_post = json[key].id_post;
                    let user_liked = json[key].user_liked == null ? 0 : json[key].user_liked;
                    let likes_count = json[key].likes_count == null ? 0 : json[key].likes_count;
                    createOnePost(connected, offset, username, photo_name, id_post, user_liked, likes_count, comment, commenter);
                  }
            }
            if (ajx.readyState == 4 && ajx.status == 401) {
                createNotificationWrapper(ajx.responseText, 'is-dark');
            }
        };
        ajx.open("POST", "./app/controllers/PostsController.php", true);
        ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajx.send(action);
    }
};

function createNotificationWrapper(responseText, type) {
    notificationWrapper = document.createElement('div');
    notificationWrapper.setAttribute('id', 'notification_wrapper');
    notificationWrapper.setAttribute('style', 'position:fixed;top:20px;width:100%;z-index:100;visibility:visible;animation:cssAnimation 0s 3s forwards;');
    notificationWrapper.innerHTML = '<div class="notification '+type+'"><div class="container"><p>'+responseText+'</p></div></div>';
    navbar.after(notificationWrapper);
}

function createOnePost(connected, offset, username, photoName, idPost, userLiked, likesCount, comment, commenter) {
    let heart = userLiked ? 'fas fa-heart fa-lg' : 'far fa-heart fa-lg';
    const ifConnectedLike = connected ? `   <span class="icon has-text-danger">
                                                <i style="cursor: pointer" id_post="`+idPost+`" class="like_btn `+heart+`"></i>
                                            </span>` : '';
    const ifConnectedComment = connected ? `    <footer class="card-footer">
                                                    <nav class="card-footer-item">
                                                        <div class="field has-addons">
                                                            <p class="control">
                                                                <input input_id_post="`+idPost+`" class="input is-small comment_input" type="text" placeholder="Add a new comment">
                                                            </p>
                                                            <p class="control">
                                                                <a class="button is-info is-outlined is-small comment_btn" id_post="`+idPost+`">
                                                                Comment
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </nav>
                                                </footer>` : '';
    let ifComment = comment ? ` <div class="level-left">
                                    <p><b>`+commenter+`</b>   `+comment+`</p>
                                </div>
                                <div class="level" style="margin-top: 10px;">
                                    <div class="level-left">
                                        <a class="title is-size-7 has-text-weight-bold has-text-grey-lighter" href="index.php?p=view_post&id=`+idPost+`">View all comments</a>
                                    </div>
                                </div>` : '';
    const likeOrLikes = likesCount == 1 ? 'like' : 'likes';
    const postsContainer = document.getElementById('posts_container');
    let newDiv = document.createElement('div');
    newDiv.className = "column is-full";
    newDiv.innerHTML = `    <div offset="`+offset+`" class="card">
                                <header class="card-header">
                                    <p class="card-header-title">
                                        `+username+`
                                    </p>
                                </header>
                                <div class="card-image">
                                    <figure class="image is-full">
                                        <img src="./app/assets/images/post_img/`+photoName+`" alt="">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="content">
                                        <div class="level">
                                            <div class="level-left">
                                                <span class="icon has-text-info comment_icon" style="margin: 0 10px 0 0;">
                                                    <a href="index.php?p=view_post&id=`+idPost+`">
                                                        <i style="cursor: pointer" class="far fa-comment fa-lg"></i>
                                                    </a>
                                                </span>`+ifConnectedLike+
                                            `</div>
                                            <div class="level-right">
                                                <div class="level-item">
                                                    <p class="subtitle is-6 has-text-weight-bold" id_post_show_likes="`+idPost+`">`+likesCount+`</p>
                                                </div>
                                                <div class="level-item">
                                                    <p class="subtitle is-6 has-text-weight-semibold">`+likeOrLikes+`</p>
                                                </div>
                                            </div>
                                        </div>`+ifComment+
                                    `</div>
                                </div>`+ifConnectedComment+  
                            `</div>`;
    postsContainer.appendChild(newDiv);
}
