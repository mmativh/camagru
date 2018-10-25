function loadCom(e) {
    e.preventDefault();
    var id = document.getElementById("p_idj").value;
    var comm = document.getElementById("c_text").value;
    console.log(comm);
    var params = 'comment=' + comm + '&p_id=' +id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            document.getElementById("com_scroll").innerHTML = this.responseText;
        } else {
            return 0;
        }
    };
    xmlhttp.open("POST", "/camagru/home/comment_create/", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function loadLike(e) {
    str = e.target.title;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ll_count").innerHTML = this.responseText;
        } else {
            return 0;
        }
    };
   xmlhttp.open("GET", "/camagru/home/like_add/"+str+"/", true);
    xmlhttp.send();
}