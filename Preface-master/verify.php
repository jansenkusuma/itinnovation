<?php 
	require_once "db.php";
	require_once "twig.php";
	if(isset($_GET['token']) && isset($_GET['email'])){
		$token = $_GET['token'];
		$email = $_GET['email'];
		$conn = konek_db();
		$query = $conn->prepare("SELECT token.profile_id FROM token LEFT JOIN profile ON profile.id = token.profile_id where profile.email = ? AND token.token = ?");
        $query->bind_param("ss", $email, $token);
        $result = $query->execute();
        $query->bind_result($profileid);
        $query->fetch();
        if ($result) {
        	
	        $verify = 0;
	        if ($profileid != null || $profileid != '') {
	        	$verify = 1;
	        	$conn2 = konek_db();
				$query = $conn2->prepare("UPDATE profile SET verify=1 where id=?");
				$query->bind_param("i", $profileid);
		        $result = $query->execute();
		        if(!$result){
		        	$verify = 0;
		        }else{
		        	$conn3 = konek_db();
		        	$query = $conn3->prepare("delete from token where profile_id=?");
					$query->bind_param("i",$id);
					$query->execute();
		        }
	        }
	        echo $twig->render("verify.html", array("verify"=>$verify));
        }
        


        	
	}else{
		echo $twig->render("verify.html", array("verify"=>0));
	} ?>