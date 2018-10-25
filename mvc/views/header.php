<?php
    if (isset($_SESSION['u_id']))
    {
        $name = "PROFILE";        
        $url = "/camagru/home/profile/";
    }
    else {
        $name = "SIGN IN / UP ";        
        $url = "/camagru/home/signin/";
    }
    echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <script src="/camagru/js/main.js"></script>
    <script src="/camagru/js/load.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="/camagru/css/main.css" />
</head>
    <body>
    <div id="load_pic"></div>
    <div id="background" onclick="close_back()">
    </div>
    <header>
        <nav>
            <div class= "c_nav">
                <a class="t_links" href="/camagru/home/index/"><img src="/camagru/img/logo2.png" height="60px" /></a>
                <a class="t_links" href="/camagru/home/index/">GALLERY</a>';
                if(isset($_SESSION['u_id'])) {
                    echo '<a class="t_links" href="/camagru/home/edit/">EDIT</a>';
                }
               echo ' <a class="t_links" href='.$url.'>'.$name.'</a>';
                if(isset($_SESSION['u_id'])) {
                    echo '<a class="t_links" href="/camagru/home/logout">LOGOUT</a>';
                }
           echo  '</div>
        </nav>
    </header> ';
?>