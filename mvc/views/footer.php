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
<div class= "c_nav">
        <hr>
        <footer>
            <li><ul><a href="/camagru/home/index/">GALLERY</a></ul></li>';
            if(isset($_SESSION['u_id'])) {
                echo '<li><ul><a href="/camagru/home/edit/">EDIT</a></ul></li>';
            }
           echo '<li><ul><a href="'.$url.'">'.$name.'</a></ul></li>
            <li><ul>mmathivh © 2018</ul></li>
        </footer> 
</div>
</body>
</html>';
?>