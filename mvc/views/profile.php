<?php if(!$_SESSION['u_id']) {
            header("Location: signup.php");
        }
?>
    <div class= "c_nav">
        <form action="/camagru/home/user_update/" method="POST" class="form_s">
        <label>Welcome back<br/>you can change your account details here</label><br/>
        <div class="clear"></div>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['u_id'];?>"/>
            <label>Firstname</label>
            <input type="text" name="fname" value="<?php echo $data['f_name']; ?>"/>
            <label>Lastname</label>
            <input type="text" name="lname" value="<?php echo $data['l_name']; ?>"/>
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $data['email']; ?>"/>
            <label>Password</label>
            <input type="password" name="passwd" value=""/>
            <div class="clear"></div>
            <input type="submit" name="submit" value="OK"/>
           <?php /* 
            if ($_SESSION['permission'] == 1)
            {
              echo   '<a href="admin_user.php?user_id=1">User admin</a>
                       <a href="admin.php?user_id=1">User admin</a>';
            } */
           ?> 
            <?php 
            if ($_SESSION['u_id']) {
                echo '<a href="/camagru/home/user_delete/'.$_SESSION['u_id'].'">Delete my account</a>';
            }
            ?>
        </form>
    </div>