<div class= "c_nav">
    <h3>Timeline</h3>
</div>
<div class= "c_navc">
<?php
    foreach ($data as $r) { 
        echo ' <div class="item">
            <div class="cor_text2">
                 <i class="far fa-calendar-minus"></i>'.$r["p_date"].' 
                <i class="fas fa-user"></i>'.$r["f_name"];
                if(isset($_SESSION['u_id'])) {
                    $sty = '"far fa-heart" style="font-size:15px;"';
                    if($r['l_id'])
                    {
                        $sty = '"fas fa-heart" style="font-size:15px; color:red;"';
                    }
               echo '<a>
                    <i class='.$sty.' title="'.$r["p_id"].'.'.$r["l_count"].'" onclick="loadLike(event)"></i> <b id="ll_count">'.$r["l_count"].'</b>
                </a>';
                }
           echo '</div>
            <a href="#" class="load_c" title="200"> 
                    <img class="load_p" src="/camagru/uploads/'.$r["image"].'" title="'.$r["p_id"].'" onclick="loadPage(event)" width="100%"/>
            </a>
            </div>';
    }    
?>
</div>
