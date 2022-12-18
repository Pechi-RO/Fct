<?php
session_start();
/*
 * ENTRAMOS A ESTA PÁGINA PARA ENVIAR EL MENSAJE
 * NO SE USA PARA NADA MÁS
 * */ 

//var_dump($_POST);

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

/*
CONFIGURACION SMTP DE siteground
*/

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.blanksinventory.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'francisco@blanksinventory.com';                     //SMTP username
    $mail->Password   = '|C1&^$_jc_b)';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('francisco@blanksinventory.com');
    $mail->addAddress($_POST['email']);     //Add a recipient


    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    $html="<p>".$_POST['texto']."</p>";
    $tlf="<p><strong>".$_POST['telefono']."</strong></p>";
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Contacto con inmobiliaria";
    $mail->Body    = $html.$tlf;
    $mail->AltBody = $_POST['texto'];

    $mail->send();
    
    $_SESSION['mensaje']="¡Mensaje enviado con éxito!";
    header('Location:contacto.php');

} catch (Exception $e) {
    echo "Error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
    $_SESSION['error']="Error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
    header('Location:contacto.php');
}