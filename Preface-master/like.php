<?php 
session_start();
require_once "db.php";
	if (isset($_GET["id"])) {
        $id = $_GET['id'];
        $conn = konek_db();
        $query = $conn->prepare("insert into post_like(post_id, user_id) values(?, ?)");
    	$query->bind_param("ii", $id, $_SESSION["profile_id"]);
   		$result = $query->execute();
   		if (! $result)
        	die("<p>Proses query gagal.</p>");
	} else {
		echo "<p>Data produk belum diisi!</p>";
	}


 ?>