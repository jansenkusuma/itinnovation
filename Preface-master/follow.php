<?php 
session_start();
require_once "db.php";
require_once "twig.php";
if(isset($_SESSION["profile_id"]) && isset($_GET["id"])){
	$user_id = $_SESSION["profile_id"];
	$profile_id = $_GET["id"];
	$conn = konek_db();
	$query = $conn->prepare("select * from profile_follower where profile_id = ? AND follower_id = ?");
    $query->bind_param("ii", $user_id, $profile_id);
    $result = $query->execute();
    $rows = $query->get_result();
    if ($rows->num_rows == 0){
    	$query = $conn->prepare("insert into profile_follower(profile_id, follower_id) values(?, ?)");
	    $query->bind_param("ii", $user_id, $profile_id);
	    $result = $query->execute();
	    if ($result) {
	    	echo "Following";
	    }
	    // else {
	    // 	echo "<javascript>alert(\"Error to Follow\")</javascript>";
	    // }
    }
    else{
        $query = $conn->prepare("DELETE FROM profile_follower WHERE profile_id = ? AND follower_id = ?");
	    $query->bind_param("ii", $user_id, $profile_id);
	    $result = $query->execute();
	    if ($result) {
	    	echo "Follow+";
	    }
	    // else {
	    // 	echo "<javascript>alert(\"Error to Unfollow\")</javascript>";
	    // }
    }

    
}
 ?>