<?php
    echo '<div class="com">
            <div class="cent" style="background-color: lightgrey;">
            <img src="/camagru/uploads/'.$param[0].'" id="pic_show" width="100%"/>
            </div>
            <div>
                <div class="com_head"></div>
                    <div id="com_scroll">';
                    foreach ($data as $r) 
                    { 
                        echo '<div class="c_item">
                                <div class="cor_text2">
                                <i class="fas fa-user"></i> '.$r["u_name"].' '.$r["c_date"].'
                                <div class="clear"></div>
                                '.$r["u_comment"].'
                                </div>
                            </div>';
                    }
    echo        '</div>';
                if (isset($_SESSION['u_id'])) {
                  echo  '<form action="#" class="c_poster" method="post">
                    <input type="hidden" id="p_idj" value="'.$param[1].'"/>
                        <textarea rows="4" name="comment" id="c_text"></textarea>
                        <div class="clear"></div>
                        <input type="submit" value="send" onclick="loadCom(event)" name="submit">
                    </form>';
                }
    echo        '</div>
        </div>';
?>