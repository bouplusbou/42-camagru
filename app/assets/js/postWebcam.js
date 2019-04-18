
/////////////////////////////////////////////////////////////////////////////// apply the right sticker
const stickers = document.getElementById('sticker_container');
const overlay = document.getElementById('overlay');
stickers.addEventListener("click", function() {
    if (event.target.tagName == 'IMG') {
        if (overlay.firstChild) {
            overlay.removeChild(overlay.firstChild);
        }
        let selected_sticker = document.createElement('img');
        selected_sticker.setAttribute('src', event.target.src);
        selected_sticker_src = event.target.src;
        selected_sticker.setAttribute('id', 'selected_sticker');
        selected_sticker.setAttribute('class', 'dragme');
        overlay.append(selected_sticker);
        const snap = document.getElementById("snap");
        if (!snap) {
            createSnapButton();
        }
    }
});

function createSnapButton() {
    const control = document.getElementById('control');
    let capture_button = document.createElement('button');
    capture_button.setAttribute('id', 'snap');
    capture_button.innerText = 'Capture';
    control.appendChild(capture_button);
}
    
////////////////////////////////////////////////////////////////////////////////////// drag the sticker
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

    //add conditions to block the move
    if (e.clientX > 640)
        targ.style.left='340px';
    else
        targ.style.left=coordX+e.clientX-offsetX+'px';
    if (e.clientY > 480)
        targ.style.top='180px';
    else
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

/////////////////////////////////////////////////////////////////////////////////////////// code
// 'use strict';

const video = document.getElementById('video');

const constraints = {
    audio: false,
    video: {
        width: 640, 
        height: 480
    }
};

// Access webcam
async function init() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleSuccess(stream);
    } catch (e) {
        // errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
    }
}

// Success
function handleSuccess(stream) {
    window.stream = stream;
    video.srcObject = stream;
}

// Load init
init();

/////////////////////////////////////////////////////////////////////////////////////////// send to server
document.addEventListener( "click", click );

function click(event){
    let element = event.target;
    if(element.id == 'snap'){
        // console.log("hi");
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, 640, 480);
        
        // Save and send to the server
        var img_data = canvas.toDataURL();
        
        // get the coord to position the src + the path
        var placement_x = parseInt(selected_sticker.style.left.length != 0 ? selected_sticker.style.left : 0, 10);
        var placement_y = parseInt(selected_sticker.style.top.length != 0 ? selected_sticker.style.top : 0, 10);
        var sticker_src = selected_sticker_src;
        
        // send to the server using AJAX
        var img_details = "action=webcam_img_montage&placement_x="+placement_x+"&placement_y="+placement_y+"&img_data="+img_data+"&sticker_src="+sticker_src;
        var ajx = new XMLHttpRequest();
        ajx.onreadystatechange = function () {
            if (ajx.readyState == 4 && ajx.status == 200) {
                document.getElementById("message").innerHTML = ajx.responseText;
                getThumbnails();
                
            }
        };
        ajx.open("POST", "./app/controllers/PostsController.php", true);
        ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajx.send(img_details);
    }
}


//////////////////////////////////////////////////////////////////// load thumbnails
function getThumbnails () {
    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            console.log(ajx.responseText);
            let thumbName = ajx.responseText;
            addLastThumbnail(thumbName);
        }
    }
    ajx.open('GET', './app/controllers/thumbnails.php', true);
    ajx.send();
}

function addLastThumbnail (thumbName) {
    const thumbCont = document.getElementById('thumbnails_container');
    let lastThumb = document.createElement('img');
    let src = "./app/assets/images/post_img/"+thumbName;
    lastThumb.setAttribute('src', src);
    thumbCont.appendChild(lastThumb);

}   