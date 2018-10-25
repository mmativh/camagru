var str;

function loadPage(e) {
    str = e.target.title;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            document.getElementById("load_pic").innerHTML = this.responseText;
            document.getElementById("load_pic").style.display = "block";
            document.getElementById("background").style.display = "block";
        } else {
            return 0;
        }
    };
   xmlhttp.open("GET", "/camagru/home/picture/"+str+"/", true);
    xmlhttp.send();
}

function loadPic(e) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("load_pic").innerHTML = this.responseText;
            document.getElementById("load_pic").style.display = "block";
            document.getElementById("background").style.display = "block";
            // Grab elements, create settings, etc.
            var video = document.getElementById('video');
            // Get access to the camera!
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // Not adding `{ audio: true }` since we only want video now
                navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                });
            }
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');
            document.getElementById("snap").addEventListener("click", function(){
            context.drawImage(video, 0, 0, 320, 240);
            document.getElementById("bt_upload2").disabled = false;
            document.getElementById("bt_upload2").style.backgroundColor = "cornflowerblue";
            document.getElementById("inp_img").value = canvas.toDataURL("image/png");
            console.log(document.getElementById("inp_img").value);
            });
        } else {
            return 0;
        }
    };
   xmlhttp.open("GET", "/camagru/home/addphoto/", true);
    xmlhttp.send();
}

function close_back() {
    document.getElementById("background").style.display = "none";
    document.getElementById("load_pic").style.display = "none";
}