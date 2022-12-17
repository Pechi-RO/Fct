<?php

/*
 * ENTRAMOS A ESTA PÁGINA PARA ENVIAR EL MENSAJE
 * NO SE USA PARA NADA MÁS
 * */ 

if(!isset($_POST['email'])){
    header('Location:index.php');
    die();
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require dirname(__DIR__,1)."/vendor/autoload.php";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '2e325d2c05071e';                     //SMTP username
    $mail->Password   = '31cedbb84d565b';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('f.ruizortega@outlook.es');
    $mail->addAddress($email);     //Add a recipient


    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $html;
    $mail->AltBody = $markdown;

    $mail->send();
    echo '¡Mensaje enviado con éxito!';
} catch (Exception $e) {
    echo "Error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
}