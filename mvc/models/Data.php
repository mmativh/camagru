<?php


class Data {

    public function user_login($user, $pass) {
        include ("config/database.php");
    try {
        $conn = $conn->prepare("SELECT * FROM c_users"); 
        $conn->execute();
        $conn->setFetchMode(PDO::FETCH_ASSOC);
        while($r = $conn->fetch()) { 
            if ($r["email"] === $user && $pass === $r["password"]) {
                $conn = null;
                return (array(
                'verified' => $r["verified"], 
                'u_id' => $r["u_id"], 
                'f_name' => $r["f_name"], 
                'l_name' => $r["l_name"]
                ));
            }
        }
        return false;
        } catch(PDOException $e) {
            echo $e;
            $conn = null;
            return false;
        }
    }

    public function user_info($id) {
        include ("config/database.php");
        $conn = $conn->prepare("SELECT * FROM c_users WHERE u_id = $id"); 
        $conn->execute();
        $conn->setFetchMode(PDO::FETCH_ASSOC);
        $ro = $conn->fetchAll();
        if (count($ro) === 1) {
            $r = $ro[0];
            return(['u_id' => $r['u_id'], 'l_name' => $r['l_name'],'f_name' => $r['f_name']
            ,'passwd' => $r['password'],'email' => $r['email']]);
        }
        return false;
    }

    public function get_comments($p_id) {
        include ("config/database.php");
        try {
            $conn = $conn->prepare("SELECT * FROM u_comments WHERE p_id = $p_id"); 
            $conn->execute();
            $conn->setFetchMode(PDO::FETCH_ASSOC);
            $r = $conn->fetchAll();
            if (count($r) == 0)
                $r = [];
            $conn = null;
            return($r);
        } catch(PDOException $e) {
            echo $e;
            $conn = null;
            return false;
        }
    }

    public function user_create($lname, $fname, $email, $passwd) {
        if($this->user_login($email, $passwd))
            return false;
        include ("config/database.php");
        try {
            echo 'hello';
            $stmt = $conn->prepare("INSERT INTO c_users (f_name, l_name, `password`, email) VALUES (:fname, :lname, :passwd, :email);");
            $stmt->execute(array(':fname' => $fname,':lname' => $lname,':passwd' => $passwd,':email' => $email));
            $conn = null;
            return true;
        } catch(PDOException $e) {
            echo $e;
            $conn = null;
            return false;
        }
    }

    public function upload($img, $u_name, $u_id) {
        include ("config/database.php");
        $stmt = $conn->prepare("INSERT INTO u_images (`image`, u_id, `f_name`) VALUES (:images, :u_id, :f_name)");
        $stmt->execute(array(':images' => $img, ':u_id' => $u_id, ':f_name' => $u_name));
        $conn = null;
        return true;
    }

    public function comment_create($p_id, $u_name, $u_id, $comment) {
        include ("config/database.php");
        $stmt = $conn->prepare("INSERT INTO u_comments (`p_id`, u_name, u_id, `u_comment`) VALUES (:p_id, :u_name, :u_id, :u_comment)");
        $stmt->execute(array(':p_id' => $p_id, ':u_id' => $u_id, ':u_comment' => $comment, ':u_name' => $u_name));
        $conn = null;
        return true;
    }
    
    public function like_search($p_id, $f_name, $u_id) {
        include ("config/database.php");
        try {
            $connt = $conn->prepare("SELECT * FROM u_likes WHERE pic_id = $p_id AND u_id = $u_id");
            $connt->execute();
            $connt->setFetchMode(PDO::FETCH_ASSOC);
            $co = $connt->fetchAll();
            $conn = null;
            return $co;
        } catch(PDOException $e) {
            echo $e;
            $conn = null;
            return false;
        }
    }

    public function like_insert($p_id, $f_name, $u_id) {
        include ("config/database.php");
        try {
            $stmt = $conn->prepare("INSERT INTO u_likes (`pic_id`, f_name, u_id) VALUES (:p_id, :f_name, :u_id)");
            $stmt->execute(array(':p_id' => $p_id, ':u_id' => $u_id, ':f_name' => $f_name));
            $conn = null;
            return true;
        } catch(PDOException $e) {
            $conn = null;
            return false;
        } 
    }

    public function like_update($p_id, $countt) {
        include ("config/database.php");
        try {
            $conn = $conn->prepare("UPDATE u_images SET l_count=:countt WHERE p_id=:p_id"); 
            $conn->execute(array(':countt' => $countt, ':p_id' => $p_id));
            $conn = null;
            return true;
          } catch(PDOException $e) {
            echo $e;
            return false;
          } 
    }

    public function user_delete($id) {
       try {
            include ("config/database.php");
            $sql = "DELETE FROM c_users WHERE u_id=$id";
            $conn = $conn->prepare($sql); 
            $conn->execute();
            $conn = null;
            return true;
        } catch(PDOException $e) {
            return false;
        } 
    }

    public function pic_delete($id) {
        try {
             include ("config/database.php");
             $sql = "DELETE FROM u_images WHERE p_id=$id";
             $conn = $conn->prepare($sql); 
             $conn->execute();
             $conn = null;
             return true;
         } catch(PDOException $e) {
             return false;
         } 
     }

    public function user_update($id, $fname, $lname, $passwd, $email) {
        try {
            include ("config/database.php");
            $sql = "UPDATE c_users SET f_name=:fname, l_name=:lname, `password`=:passwd, email=:email WHERE u_id=:id";
            $conn = $conn->prepare($sql); 
            $conn->execute(array(':fname' => $fname,':lname' => $lname,':passwd' => $passwd,':email' => $email, ':id' => $id));
            $conn = null;
            return true;
          } catch(PDOException $e) {
            return false;
          }
    }

    public function index_data_u($u_id) {
       try {
            include ("config/database.php");
            $sql = "SELECT * FROM u_images
                    LEFT JOIN u_likes ON $u_id = u_likes.u_id AND u_images.p_id = u_likes.pic_id
                    WHERE post = 1"; 
            $conn = $conn->prepare($sql); 
            $conn->execute();
            $conn->setFetchMode(PDO::FETCH_ASSOC);
            $r = $conn->fetchAll();
           // echo '<pre>';
           // print_r($r);
          //  echo '</pre>';
            return ($r);
          } catch(PDOException $e) {
              echo $e;
            return false;
          } 
    }
    public function index_data() {
        try {
             include ("config/database.php"); 
             $conn = $conn->prepare("SELECT * FROM u_images WHERE post = 1"); 
             $conn->execute();
             $conn->setFetchMode(PDO::FETCH_ASSOC);
             return ($conn->fetchAll());
           } catch(PDOException $e) {
               echo $e;
             return false;
           } 
     }
    public function get_pic($p_id) {
        try {
             include ("config/database.php");
             $sql = "SELECT * FROM u_images WHERE p_id = $p_id"; 
             $conn = $conn->prepare($sql); 
             $conn->execute();
             $conn->setFetchMode(PDO::FETCH_ASSOC);
             $r = $conn->fetchAll();
             return ($r[0]['image']);
           } catch(PDOException $e) {
             return false;
           } 
     }

    public function edit_data() {
        try {
             include ("config/database.php");
             $sql = "SELECT * FROM u_images WHERE post = 0"; 
             $conn = $conn->prepare($sql); 
             $conn->execute();
             $conn->setFetchMode(PDO::FETCH_ASSOC);
             $r = $conn->fetchAll();
             return ($r);
           } catch(PDOException $e) {
             return false;
           } 
     } 

}
?>