<?php
 require_once('./PHPMailer/class.SMTP.php');
 require_once('./PHPMailer/class.phpmailer.php');

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.es";
$mail->Port = 587;
$mail->Username = "prueba@iesjoseplanes.es";
$mail->Password = "password";
$body ="<h1>Texto del mensaje</h1>";
$mail->SetFrom('usuario', 'Nombre y Apellidos, etc.');
$mail->MsgHTML($body);
$address = "jgallegohijo@gmail.com";
$mail->AddAddress($address, "Nombre del destinatario");
$mail->AddAttachment('Creacion_de_Adan.jpg', 'Creacion_de_Adan.jpg');
?>