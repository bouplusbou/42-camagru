const token = document.getElementById('token').value;


/////////////////// STICKERS ///////////////////

const stickers = document.getElementById('sticker_container');
const overlay = document.getElementById('overlay');
const btnSnap = document.getElementById('button_snap');

stickers.addEventListener("click", function() {
    if (event.target.tagName == 'IMG') {
        if (overlay.firstChild) {
            overlay.removeChild(overlay.firstChild);
        }
        let selected_sticker = document.createElement('img');
        selected_sticker.setAttribute('src', event.target.src);
        selected_sticker_src = event.target.src;
        selected_sticker.setAttribute('id', 'selected_sticker');
        selected_sticker.className = 'dragme';
        overlay.append(selected_sticker);
        btnSnap.className = 'button is-info';
    }
});

// drag the sticker
function startDrag(e) {
    // determine event object
    if (!e) {
        var e = window.event;
    }
    
    // IE uses srcElement, others use target
    var targ = e.target ? e.target : e.srcElement;
    
    if (targ.className != 'dragme') {return};
    // calculate event X, Y coordinates
    offsetX = e.clientX;
    offsetY = e.clientY;
    
    // assign default values for top and left properties
    if(!targ.style.left) { targ.style.left='0px'};
    if (!targ.style.top) { targ.style.top='0px'};
    
    // calculate integer values for top and left properties
    coordX = parseInt(targ.style.left);
    coordY = parseInt(targ.style.top);
    drag = true;
    
    // move div element
    document.onmousemove=dragDiv;
}

function dragDiv(e) {
    //check if concern img only
    if (event.target.tagName != 'IMG')
    return;
    
    if (!drag) {return};
    if (!e) { var e= window.event};
    var targ=e.target?e.target:e.srcElement;
    
    targ.style.left=coordX+e.clientX-offsetX+'px';
    targ.style.top=coordY+e.clientY-offsetY+'px';
    return false;
}

function stopDrag() {
    drag=false;
}

window.onload = function() {
    document.onmousedown = startDrag;
    document.onmouseup = stopDrag;
}




/////////////////// MONTAGE ///////////////////

// display filename
const file = document.getElementById('file');
file.onchange = function(){
    if(file.files.length > 0)
    {
        filename.innerHTML = file.files[0].name;
    }
};


// snap it !
btnSnap.addEventListener("click", function() {
    
    const img_src = document.getElementById('uploaded_img').src;
    
    // get the coord to position the src + the path
    const placement_x = parseInt(selected_sticker.style.left.length != 0 ? selected_sticker.style.left : 0, 10)-20;
    const placement_y = parseInt(selected_sticker.style.top.length != 0 ? selected_sticker.style.top : 0, 10)-30;
    
    const action = "action=upload_img_montage&placement_x="+placement_x+"&placement_y="+placement_y+"&img_src="+img_src+"&sticker_src="+selected_sticker_src+'&token='+token;
    // console.log(action);
    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            // document.getElementById("message").innerHTML = ajx.responseText;
            console.log(ajx.responseText);
            getThumbnails();
        }
        if (ajx.readyState == 4 && ajx.status == 401) {
            createNotificationWrapper(ajx.responseText, 'is-dark');
        }
    };
    ajx.open("POST", "./app/controllers/PostsController.php", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
});



/////////////////// THUMBNAILS ///////////////////

function getThumbnails () {
    const action = "action=get_thumbnails";
    
    const ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            let thumbName = ajx.responseText;
            addLastThumbnail(thumbName);
        }
    }
    ajx.open('POST', './app/controllers/PostsController.php', true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(action);
}

function addLastThumbnail (thumbName) {
    if (document.querySelectorAll('.thumbnail').length >= 6) {
        const thumbnailsContainer = document.getElementById('thumbnails_container');
        thumbnailsContainer.lastElementChild.remove();
    }
    const lastPostsTitle = document.getElementById('last_posts_title');
    let lastThumb = document.createElement('img');
    let src = "./app/assets/images/post_img/"+thumbName;
    lastThumb.setAttribute('src', src);
    lastThumb.className = 'thumbnail';
    lastPostsTitle.after(lastThumb);
}   


/////////////////// NOTIFICATIONS ///////////////////

function createNotificationWrapper(responseText, type) {
    notificationWrapper = document.createElement('div');
    notificationWrapper.setAttribute('id', 'notification_wrapper');
    notificationWrapper.setAttribute('style', 'position:fixed;top:20px;width:100%;z-index:100;visibility:visible;animation:cssAnimation 0s 3s forwards;');
    notificationWrapper.innerHTML = '<div class="notification '+type+'"><div class="container"><p>'+responseText+'</p></div></div>';
    navbar.after(notificationWrapper);
}