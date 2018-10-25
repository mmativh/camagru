
<div class= "c_nav">
    <h3>Edit pictures</h3>
</div>
<div class="c_nav"> 
    <div class="edit_t">
        <div class="d_block">
            <canvas id="canvase" width="500" height="500"></canvas>
            <form method="post" action="/camagru/home/upload_web/">
                <input id="inp_img" name="img" type="hidden" value="">
                <input id="bt_upload" type="submit" value="Upload" style="background-color: gray;" disabled>
            </form>
            <div class="clear"></div>
        </div>
        <div class="d_block">
            <h4>Uploaded pics</h4>
            <div class="d_block2">
                <?php
                    foreach ($data as $r) { 
                        echo '<div>
                                <div class="close_p"><i class="fas fa-times"></i></div>
                                <img src="/camagru/uploads/'.$r['image'].'" width="100%" onclick="placePic(event)"/>
                            </div>';
                    }  
                ?>
                <div class="add" onclick="loadPic(event)">
                <i class="fas fa-camera"></i>
                <div class="clear"></div>
                 Add pics
                 </div>
            </div>
            <h4>Stickers</h4>
            <div class="d_block2">
            <div><img src="/camagru/uploads/clip2.png" onclick="placeStic(event)" width="100%"/></div>
            <div><img src="/camagru/uploads/clip.png" onclick="placeStic(event)" width="100%"/></div>
                <?php /*
                    foreach ($data as $r) { 
                        echo '<div><img src="/camagru/uploads/'.$r['image'].'" width="100%"/></div>';
                    }  */
                ?>
            </div>
        </div>
    </div>
</div>
<script src="/camagru/js/canvas.js"></script>
