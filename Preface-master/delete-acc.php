<?php 
session_start();
require_once "db.php";

$conn = konek_db();
if(isset($_SESSION["profile_id"])){
	$id = $_SESSION["profile_id"];
	$query = $conn -> prepare("select * from profile where id=?");
	$query->bind_param("i",$id);
	$result = $query->execute();

	if(!$result)
		die("gagal query");
	$rows = $query->get_result();
	if($rows->num_rows==0)
		die("profile tidak ditemukan");
	$profile = $rows->fetch_object();
	$image = $profile->image;
	if($image != null && file_exists("images/$image")) {
		//hapus image
		unlink("profile/$image");
	}

	$query = $conn->prepare("delete from profile where id=?");
	$query->bind_param("i",$id);
	$result = $query->execute();

	if($result){
		session_destroy();
		header("Location:login.php");
	}

	else
		echo"<p>Gagal mendelete data profile</p>";
}

 ?>