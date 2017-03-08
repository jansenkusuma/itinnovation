<?php 
	session_start();
	require_once "db.php";
	require_once "PHPMailer/PHPMailerAutoload.php";
    require_once "twig.php";
    echo "<javascript>console.log(\"1\")";
    $conn = konek_db();
	$query = $conn->prepare("select token, email from token left join profile on profile.id = token.profile_id where profile_id = ?");
	$query->bind_param("i", $_SESSION['profile_id']);
	$query->execute();
	$query->bind_result($token, $email);
	$query->fetch();
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
    $mail->Subject = "Verification email Random.com";
    $mail->MsgHTML($twig->render("mail.html", array("link"=>$link)));
    echo "<javascript>console.log(\"2\")";
    if (!$mail->send())
        echo "Mailer Error: " . $mail->ErrorInfo;
 ?>