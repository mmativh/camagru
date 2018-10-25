var canvas2 = document.getElementById("canvase");
var ctx = canvas2.getContext('2d');
var img1 = new Image();
img1.src = '';
var img2 = new Image();
img2.src = '';
var imagesLoaded = 1;


function placePic(e) {
    ctx.clearRect(0,0,500,500);
    img1.src = e.target.src;
    ctx.drawImage(img1, 0, 0, 500, 500);
    ctx.drawImage(img2, 1, 0);
    document.getElementById("bt_upload").disabled = false;
    document.getElementById("bt_upload").style.backgroundColor = "cornflowerblue";
    document.getElementById("inp_img").value = canvas2.toDataURL("image/png");
}

function placeStic(e) {
    ctx.clearRect(0,0,500,500);
    img2.src = e.target.src;
    ctx.drawImage(img1, 0, 0, 500, 500);
    ctx.drawImage(img2, 1, 0);
    document.getElementById("bt_upload").disabled = false;
    document.getElementById("bt_upload").style.backgroundColor = "cornflowerblue";
    document.getElementById("inp_img").value = canvas2.toDataURL("image/png");
}
