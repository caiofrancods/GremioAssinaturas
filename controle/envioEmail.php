<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

session_start();

Function enviarEmail($email, $codigo, $nomeSign, $nomeDoc){
    try{
    $mail = new PHPMailer(true);
    
    include 'acessoServer.php';
    
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = host();                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = user();                     //SMTP username
    $mail->Password = pass();                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port = port();                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
    $mail->CharSet = 'UTF-8';

    //Recipients
    $mail->setFrom('noreply@gremiotimoteo.online', 'Grêmio Assinaturas');
    $mail->addAddress($email, 'Signatario');     //Add a recipient

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "[Grêmio Assinaturas] Documento disponivel para assinatura";
    $mail->Body = 'Olá ' . $nomeSign . '!<br><br>';
    $mail->Body .= 'O documento ' . $nomeDoc . ' aguarda a sua assinatura! <br>' ;
    $mail->Body .= 'Acesse pelo link: <a href="https://assinatura.gremiotimoteo.online/documento.php?codigo=' . $codigo . '">https://assinatura.gremiotimoteo.online/documento.php?codigo=' . $codigo . '</a>';

    $mail->send();
    }
    catch(Exception $e){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        die();
    }
}
?>