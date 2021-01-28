<?php
    // Especificar correctamente el path al archivo class.phpmailer.php
    require_once('./PHPMailer/class.smtp.php');
	require_once('./PHPMailer/class.phpmailer.php');

    function save_mail($mail)
    {
        //You can change 'Sent Mail' to any other folder or tag
        $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
        //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
        $imapStream = imap_open($path, $mail->Username, $mail->Password);
        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
        imap_close($imapStream);
        return $result;
    }   

    $mail             = new PHPMailer();

    $body             = "Prueba de envio"; // Cuerpo del mensaje
    $mail->IsSMTP(); // Usar SMTP para enviar
    $mail->SMTPDebug  = 1; // habilita información de depuración SMTP (para pruebas)
                           // 1 = errores y mensajes
                           // 2 = sólo mensajes
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth   = true; // habilitar autenticación SMTP
    $mail->Host       = "smtp.gmail.com"; // establece el servidor SMTP
    $mail->Port       = 587; // configura el puerto SMTP utilizado 25
    $mail->Username   = "user@gmail.com"; // nombre de usuario UGR
    $mail->Password   = "*****"; // contraseña del usuario UGR


    $body = "Texto del mensaje";

    $mail->SetFrom('usuario', 'Nombre y Apellidos, etc.');
    $mail->Subject    = "Asunto del mensaje";
    $mail->MsgHTML($body); // Fija el cuerpo del mensaje

    $address = "frm@gmail.com"; // Dirección del destinatario
    $mail->AddAddress($address, "Nombre del destinatario");

	/*$file = 'gmail.php';
	$mail->AddAttachment( $file, 'gmail.php' );
    */
	if(!$mail->Send()) {
        echo "Error: " . $mail->ErrorInfo;
    }
    else {
        echo "¡Mensaje enviado!";
        //if(save_mail($mail));
        //echo "¡Mensaje guardado!";
    }

    
?>
