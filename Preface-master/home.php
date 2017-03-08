<?php 
    session_start();
    function time_passed($datetime, $full = false) {
        date_default_timezone_set('Asia/Bangkok');
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    require_once "db.php";
    require_once "twig.php";
    $error = false;
    $pesan = null;
    $post = '';
    // if (! isset($_SESSION["profile_id"])) {
    //     echo $twig->render("login.html");
    // }else { 
    $conn2 = konek_db();
    $query2 = $conn2->prepare("select post.description, post.datetime, post.id, post.profile_id, post.image, profile.profile_pic, login.username from post LEFT JOIN profile ON profile.id = post.profile_id LEFT JOIN login ON login.profile_id = profile.id ORDER BY post.datetime DESC");
    $result = $query2->execute();
    $data = array();
    if (!$result){
        $error = true;
    }
    else {
        $rows = $query2->get_result();
        while ($row = $rows->fetch_array()) {
            if($row["profile_pic"] == null)
                $profile_pic = "profile/no-pic.png";
            else
                $profile_pic = "profile/" . $row["profile_pic"];
            $url_image = 'post/' . $row['image'];
            $desc = $row["description"];
            $postdate = time_passed($row["datetime"]);
            $id = $row["id"];
            $profileid = $row["profile_id"];
            $username = $row["username"];
            $access = 0;
            if (isset($_SESSION["profile_id"])) {
                if ($profileid == $_SESSION['profile_id']) {
                    $access = 1;
                }
            }
            $post = array("id"          =>$id,
                           "profile_id"  =>$profileid,
                           "profile_pic" =>$profile_pic,
                           "username"    =>$username,
                           "image"       =>$url_image,
                           "description" =>$desc,
                           "postdate"    =>$postdate,
                           "access"      =>$access);
            array_push($data, $post);
        }
    }
    if (isset($_SESSION["profile_id"])) {
        $conn = konek_db();
        $query = $conn->prepare("select verify, email from profile where id = ?");
        $query->bind_param("i", $_SESSION['profile_id']);
        $query->execute();
        $query->bind_result($verify, $email);
        $query->fetch();
        
             
            //eksekusi query untuk tarik data dari database
        
        $verification = array('verify' => $verify, 
                              'email'  => $email,
                              'error'  => $error,
                              'login'  => '1');
        //tarik data ke result set
        echo $twig->render("home.html", array_merge(array("posts"=>$data),array("verify"=>$verification)));
    }else{
        $verification = array('verify' => '1', 
                              'email'  => '',
                              'error'  => $error,
                              'login'  => '0');

        echo $twig->render("home.html", array_merge(array("posts"=>$data),array("verify"=>$verification)));
    }
    // }
?>