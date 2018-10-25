<div class= "c_nav">
    <div class= "pic">
        <div class= "fo">
            <div class= "vidc">
                <video id="video" width="320" height="240" autoplay></video>
                <input type="submit" id="snap" value="Take photo">
            </div>
            <form method="post" id="formc" action="/camagru/home/upload_web/">
                <canvas id="canvas" width="320" height="240"></canvas>
                <input id="inp_img" name="img" type="hidden" value="">
                <input id="bt_upload2" type="submit" value="Upload" style="background-color: gray;" disabled>
            </form>
        </div>
        <div class= "fo">
            <form action="/camagru/home/upload_web/" style="margin-top: 100px;" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload"/>
                <input type="submit" value="Upload Image" name="submit" disabled>
            </form>
        </div>
    </div>
</div>
