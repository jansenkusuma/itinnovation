<?php 
session_start();
require_once "db.php";
echo isset($_POST['hidden-id']) + "\n";
echo $_POST['hidden-id'] + "\n";
if ($_POST['hidden-id'] == 0) {
    
	if (isset($_FILES["image"])) {
        $description = isset($_POST['desc']) ? $_POST['desc'] : '';
        $file_gambar = "";
        if ($_FILES["image"]["error"] == 0){
            $image = $_FILES["image"];
            $extension = new SplFileInfo($image['name']);
            $extension = $extension -> getExtension();
            $count = $_SESSION["post_count"] + 1;
            $file_gambar = $_SESSION["profile_id"] . '-' . $count . '.' . $extension;

            copy ($image['tmp_name'], 'post/' . $file_gambar);        
        }
        $conn = konek_db();
        $query = $conn->prepare("insert into post(profile_id, image, description, datetime) values(?, ?, ?, now())");
    	$query->bind_param("iss", $_SESSION["profile_id"], $file_gambar, $description);
   		$result = $query->execute();
   		if (! $result)
        	die("<p>Proses query gagal.</p>");
        $_SESSION["post_count"] = $count;
		echo "<p>Data produk berhasil ditambahkan.</p>";
		header("Location: home.php");

	} else {
		echo "<p>Data produk belum diisi!</p>";
	}
}else {
    $id = $_POST['hidden-id'];
    $description = isset($_POST['desc']) ? $_POST['desc'] : '';
    $conn = konek_db();
    $query = $conn->prepare("select * from post where id = ?");

    $query->bind_param("i", $id);
    $result = $query->execute();

    if (! $result)
        die("gagal query");

    $rows = $query->get_result();
    if ($rows->num_rows == 0)
        die("Post tidak ditemukan");

    $post = $rows->fetch_object();
    $file_gambar = '';
    if(isset($_FILES["image"])){
        if($_FILES["image"]["error"] == 0) {
            //hapus gambar lama
            $imagename = $post->image;
            if($imagename != null && file_exists("post/$imagename")) {
                unlink("post/$image");
                echo "delete";
            }

            //salin gambar yang diupload ke folder images
            
            if(isset($_FILES["image"])) {
                if($_FILES["image"]["error"] == 0) {
                    $image = $_FILES["image"];
                    $extension = new SplFileInfo($image['name']);
                    $extension = $extension->getExtension();
                    echo "$extension";
                    $file_gambar = substr($imagename, 0, -4) . '.' . $extension;
                    copy ($image['tmp_name'], 'post/' . $file_gambar);
                }
            }
            echo $file_gambar;
        } else {
            //tetap file gambar yang lama
            $file_gambar = $post->image;
        }
    }
    $conn = konek_db();
    $query = $conn->prepare("UPDATE post SET description = ? where id = ?");
    $query->bind_param("si", $description, $id);
    $result = $query->execute();
    if (! $result)
        die("<p>Proses query gagal.</p>");
    echo "<p>Data post berhasil ditambahkan.</p>";
    header("Location: home.php");
}

 ?>