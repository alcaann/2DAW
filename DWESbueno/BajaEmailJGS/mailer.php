<?php
 // Especificar correctamente el path al archivo class.phpmailer.php
 require_once('./PHPMailer/class.SMTP.php');
 require_once('./PHPMailer/class.phpmailer.php');


 function mandar_correo($id, $direction, $username){

 
 $mail = new PHPMailer();

 $body = "Prueba de envio"; // Cuerpo del mensaje
 $mail->IsSMTP(); // Usar SMTP para enviar
 $mail->SMTPDebug = 0; // habilita información de depuración SMTP (para pruebas)
 // 1 = errores y mensajes
 // 2 = sólo mensajes
 $mail->SMTPAuth = true; // habilitar autenticación SMTP
 $mail->Host = "smtp.1and1.es"; // establece el servidor SMTP
 $mail->Port = 587; // configura el puerto SMTP utilizado 25
 $mail->Username = "prueba@iesjoseplanes.es"; // nombre de usuario UGR
 $mail->Password = "mypassword"; // contraseña del usuario UGR
 
 
 $body = "Aquí te dejo el cuadrito bueno
 
 
 
 <a href='http://localhost/2DAW/DWESbueno/BajaEmailJGS/baja.php?id={$id}'>Darse de baja</a>";
	
 $mail->SetFrom('Consejería de educación', 'Fernando');
 $mail->Subject = "Envío de foto para {$username}";
 $mail->MsgHTML($body); // Fija el cuerpo del mensaje

 $address = "jgallegohijo@gmail.com"; // Dirección del destinatario
 $mail->AddAddress($direction, $username);
 $mail->AddAttachment( 'Creacion_de_Adan.jpg' , 'Creacion_de_Adan.jpg' );

 if(!$mail->Send()) 
 {
	echo "Error: " . $mail->ErrorInfo;
 }
 else 
 {
	echo "¡Mensaje enviado!";
 }
}
?>