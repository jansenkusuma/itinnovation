
<?php

require_once "db.php";
if(isset($_GET['username'])){
	$name=trim($_GET['username']) . "%";
	$conn = konek_db();
    $query = $conn->prepare("SELECT profile.id, login.username, profile.profile_pic from login LEFT JOIN profile ON profile.id = login.profile_id where username like ? LIMIT 5");
    $query->bind_param("s", $name);
    $result = $query->execute();
    if (!$result) {
    	die("shit");
    }
    $rows = $query->get_result();
    $data = array();
    while ($row = $rows->fetch_array()) {
        if($row["profile_pic"] == null)
            $profile_pic = "profile/no-pic.png";
        else
            $profile_pic = "profile/" . $row["profile_pic"];
        $profileid = $row["id"];
        $username = $row["username"];
        $user = array("id"  =>$profileid,
                      "pic" =>$profile_pic,
                      "username"=>$username);
        array_push($data,$user);
    }
    // echo json_encode(array("data"=>$data));
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($data);
    exit;
}
?>
		