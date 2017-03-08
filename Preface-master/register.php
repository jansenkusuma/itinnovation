<?php
session_start();
require_once "db.php";
require_once "PHPMailer/PHPMailerAutoload.php";
require_once "twig.php";
function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if(!isset($_SESSION["profile_id"])){
    if (isset($_POST["nama"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = sha1($_POST["password"]);
        $conn = konek_db();
        $query = $conn->prepare("insert into profile(fullname, email) values(?, ?)");
        $query->bind_param("ss", $nama, $email);
        $result = $query->execute();
        $id = mysqli_insert_id($conn);
        if (!$result){
            header("Location:login.php");
            die("<script type='text/javascript'>alert('Failed to Register.');</script>");
        }
        else {
            $query = $conn->prepare("insert into login(username, password, profile_id) values(?, ?, ?)");
            $query->bind_param("ssi", $username, $password, $id);
            $result = $query->execute();
            if ($result) {
                $token= generateRandomString();
                $query = $conn->prepare("insert into token(token, profile_id) values(?, ?)");
                $query->bind_param("ss", $token, $id);
                $result = $query->execute();
                if ($result) {
                    $_SESSION['profile_id'] = $id;
                    $_SESSION['post_count'] = 0;
                    $link = 'localhost/Preface-master/Preface-master/verify.php?token=' . $token . '&email=' . $email;
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'preface.community@gmail.com';
                    $mail->Password = 'prefacecom';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->setFrom("preface.community@gmail.com", "Preface");
                    $mail->addAddress($email);
                    $mail->addReplyTo("preface.community@gmail.com");
                    $mail->Subject = "Verification email PREFACE";
                    $mail->MsgHTML($twig->render("mail.html", array("link"=>$link)));
                    if (!$mail->send())
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    header("Location:home.php");
                }
            }
            else {
                $query = $conn->prepare("delete from profile where id=?");
                $query->bind_param("i",$id);
                $result = $query->execute();
                echo "<script type='text/javascript'>alert('Failed to Register.');</script>";
                header("Location:login.php");
            }
        }
    } else {
        echo "<script type='text/javascript'>alert('Data pribadi belum diisi.');</script>";
        header("Location:login.php");
    }
} else {
    header("Location:home.php");
}
?>