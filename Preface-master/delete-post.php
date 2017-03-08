<?php 
require_once "db.php";

$conn = konek_db();

if(! isset($_GET["id"]))
	die("tidak ada id produk");

$id = $_GET["id"];
$query = $conn -> prepare("select * from post where id=?");
$query->bind_param("i",$id);
$result = $query->execute();

if(!$result)
	die("gagal query");
$rows = $query->get_result();
if($rows->num_rows==0)
	die("produk tidak ditemukan");
$post = $rows->fetch_object();
$image = $post->image;
if($image != null && file_exists("Post/$image")) {
	//hapus image
	unlink("Post/$image");
}
$conn = konek_db();
$query = $conn->prepare("delete post, post_like, post_comment from post LEFT JOIN post_like ON post_like.post_id = post.id LEFT JOIN post_comment ON post_comment.post_id = post.id where post.id =?");
$query->bind_param("i",$id);
$result = $query->execute();

if($result)
	echo"<p>Data post berhasil di didelete</p>";
else
	echo"<p>Gagal mendelete data produk</p>";


 ?>