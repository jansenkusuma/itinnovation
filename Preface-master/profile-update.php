<?php
	session_start();
    require_once "db.php";
    require_once "twig.php";
    if (!isset($_POST['update'])) {
    	 if(isset($_SESSION["profile_id"])){
	        $id = $_SESSION["profile_id"];
	    }else{
	        header("Location:login.php");
	    }    
	    $conn = konek_db();
	    $query = $conn->prepare("select * from profile where id = ?");
	    $query->bind_param("i", $id);
	    $result = $query->execute();
	    if (!$result) {
	        die("die");
	    }
	    $rows = $query->get_result();
	    $row = $rows->fetch_object();
        $profil = array('job' => $row->job,
                         'name' => $row->fullname,
                         'dob' => $row->dateofbirth,
                         'phone' => $row->phone,
                         'email' => $row->email,
                         'website' => $row->website,
                         'description' => $row->description
                        );
        echo $twig->render("profile-update.html", $profil);
    }
    else{
    	$id = $_SESSION['profile_id'];
		$fullname = $_POST["fullname"];
		$date = $_POST["date"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		$website = $_POST["website"];
		$job = $_POST["job"];
		$desc = $_POST["desc"];
		$conn = konek_db();
		$query = $conn->prepare("select * from profile where id=?");
		$query->bind_param("i", $id);
		$result = $query->execute();

		if (! $result)
			die("gagal query");

		$rows = $query->get_result();
		if ($rows->num_rows == 0)
			die("Profile tidak ditemukan");

		$profile = $rows->fetch_object();
		$file_gambar = '';
		if(isset($_FILES["profile-img"])){
			if($_FILES["profile-img"]["error"] == 0) {
				//hapus gambar lama
				$image = $profile->profile_pic;
				if($image != null && file_exists("profile/$image")) {
					unlink("profile/$image");
			}

			//salin gambar yang diupload ke folder images
			
			if(isset($_FILES["profile-img"])) {
				if($_FILES["profile-img"]["error"] == 0) {
					$image = $_FILES["profile-img"];

					$extension = new SplFileInfo($image['name']);
					$extension = $extension->getExtension();
					$file_gambar = $id . '.' . $extension;
					copy ($image['tmp_name'], 'profile/' . $file_gambar);
				}
			}
			} else {
				//tetap file gambar yang lama
				$file_gambar = $profile->profile_pic;
			}
		}


		$query = $conn->prepare("UPDATE profile set fullname=?, dateofbirth=?, phone=?, email=?, website=?, job=?, description=?, profile_pic=? where id=?");
		$query->bind_param("ssssssssi" , $fullname, $date, $phone, $email, $website, $job, $desc, $file_gambar, $id);
		$result = $query->execute();

		if($result){
			echo "<p>Data profile berhasil di update</p>";
			header("Location:profile.php");
			}
		else
			echo "<p>Gagal Mengupdate Data profile</p>";
    }


?>