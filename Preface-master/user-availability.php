<?php 
require_once "db.php";
if(isset($_POST["username"])){
	$username = $_POST["username"];
	$conn = konek_db();
	$query = $conn->prepare("SELECT count(*) FROM login where username = ?");
	$query->bind_param("s", $username);
	$query->execute();
	$query->bind_result($row_count);
	$query->fetch();
	if($row_count>0) 
		echo "<span class='status-not-available' style=\"color : red;\"> Username Not Available.</span>";
	else 
		echo "<span class='status-available' style=\"color : green;\"> Username Available.</span>";
}

 ?>