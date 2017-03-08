<?php
	session_start();
    require_once "db.php";
    require_once "twig.php";
    if (! isset($_SESSION["profile_id"]) && ! isset($_POST["username"]) && ! isset($_POST["password"])) {
    	echo $twig->render("login.html");
    }
    if (isset($_SESSION["profile_id"]))
        header("Location: home.php");
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = sha1($_POST["password"]);
        $conn = konek_db();
		$query = $conn->prepare("select password, login.profile_id, count(post.profile_id) from login left join post on post.profile_id = login.profile_id where username = ?");
		
		$query->bind_param("s", $username);
		$query->execute();
		$query->bind_result($pass, $id, $post_count);
		$query->fetch();
		if ($password != null || $password == '') {
			if ($password == $pass) {
                $_SESSION["profile_id"] = $id;
                $_SESSION["post_count"] = $post_count;
                header("Location: home.php");
            } else {
                echo "<p>Username/Password salah</p>";
            }
		}else {
			echo "<p>Username/Password salah</p>";
		}
    }
?>