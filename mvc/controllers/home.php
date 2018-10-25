<?php

class home extends controller
{
   
   public function index() {
        $userss = $this->model('Data');
        if(isset($_SESSION['u_id']))
            $data = $userss->index_data_u($_SESSION['u_id']);
         else 
            $data = $userss->index_data();
        $this->view('header');
        $this->view('home',$data);
        $this->view('footer');
    }

    public function picture($p_id = '') {
        $userss = $this->model('Data');
        $name = $userss->get_comments($p_id[0]);
        $pic[] = $userss->get_pic($p_id[0]);
        $pic[] = $p_id[0];
        $this->view('picture',$name, $pic);
    }

    public function comment_create() {
        $com = $_POST['comment'];
        $p_id = $_POST['p_id'];
        $userss = $this->model('Data');
        $name = $userss->comment_create($p_id, $_SESSION['f_name'], $_SESSION['u_id'], $com);
        $data = $userss->get_comments($p_id);
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
    }

    public function addphoto() {
        $this->view('addphoto');
    }

    public function like_add($p_id) {
        $userss = $this->model('Data');
        $ar = explode('.', $p_id[0]);
        $count1 = count($userss->like_search($ar[0], $_SESSION['f_name'], $_SESSION['u_id']));
        if (!$count1) {
           $up = $userss->like_update($ar[0], $ar[1]+1);
           $in = $userss->like_insert($ar[0], $_SESSION['f_name'], $_SESSION['u_id']);
           if ($up && $in) {
            echo $ar[1]+1;
            return 0;
           }
        } 
        echo $ar[1];
    }

    public function upload_web() {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $up = $this->model('Data');
                    $up->upload(basename($_FILES["fileToUpload"]["name"]), $_SESSION['f_name'] , $_SESSION['u_id']);
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "File is not an image.";
            }
        }
        
        if(isset($_POST['img']))
        {
            if (count($_POST) && (strpos($_POST['img'], 'data:image/png;base64') === 0)) {
                $img = $_POST['img'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $img = 'img'.date("YmdHis").'.png';
                $file = 'uploads/'.$img;
                $up = $this->model('Data');
                $up->upload($img, $_SESSION['f_name'], $_SESSION['u_id']);
                if (file_put_contents($file, $data)) {
                    echo "<p>The canvas was saved as $file.</p>";
                } else {
                    echo "<p>The canvas could not be saved.</p>";
                } 
            }
        }
    }
    public function signup() {
        $this->view('header');
        $this->view('signup');
        $this->view('footer');
    }

    public function signin() {
        $this->view('header');
        $this->view('signin');
        $this->view('footer');
    }

    public function edit() {
        if(!isset($_SESSION['u_id'])) {
            header("Location: /camagru/home/index/");
        }
        $userss = $this->model('Data');
        $data = $userss->edit_data();
        $this->view('header');
        $this->view('edit', $data);
        $this->view('footer');
    }

    public function profile() {
        $userss = $this->model('Data');
        $data = $userss->user_info($_SESSION['u_id']);
        $this->view('header');
        $this->view('profile', $data);
        $this->view('footer');
    }

    public function user_delete($d = '') {
        $userss = $this->model('Data');
        $data = $userss->user_delete($d[0]);
        session_destroy();
        header("Location: /camagru/home/index/");
    }

    public function user_create() {
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $passwd = $_POST['passwd'];
        if ($lname && $fname && $email && $passwd) {
            $userss = $this->model('Data');
            $data = $userss->user_create($lname , $fname, $email, $passwd);
        } else {
            header("Location: /camagru/home/index/");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /camagru/home/index/");
    }

    public function login_user() {
        $email = $_POST['email'];
        $passwd = $_POST['passwd'];
        if ($email && $passwd) {
            $userss = $this->model('Data');
            $data = $userss->user_login($email, $passwd);
            if (!$data) {
                header("Location: /camagru/home/signup/");
                return false;
            }
            $_SESSION['verified'] = $data['verified'];
            $_SESSION['f_name'] = $data['f_name'];
            $_SESSION['l_name'] = $data['l_name'];
            $_SESSION['u_id'] = $data['u_id'];
            header("Location: /camagru/home/index/");
        } else {
            header("Location: /camagru/home/signup/");
        }
    }
} 

?>