<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

function sendEmail($email, $nome){

$mail = new PHPMailer(true);

try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.extingandhiextintores.com.br';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'vendas@extingandhiextintores.com.br';                     // SMTP username
    $mail->Password   = '*Trimcorp2255887';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;
   // $mail->setLanguage('pt_br', './vendor/phpmailer/phpmailer/language/')                                    


    //Recipients
    $mail->setFrom('vendas@extingandhiextintores.com.br', 'Extingandhi');
    $mail->addAddress($email, $nome);     // Add a recipient
   // $mail->addAddress('ellen@example.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    // Attachments
   $mail->addAttachment('download.jpg');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Cadastro QRProject';
    $mail->Body    = 'Seu cadastro foi realizado com sucesso!';
    $mail->AltBody = 'Seu cadastro foi realizado com sucesso!';

    $mail->send();
    //echo 'Message has been sent';
    echo json_encode("<h1>Email enviado</h1>");
    return true;
} catch (Exception $e) {
   //echo json_encode('<h1> Ocorreu um erro no envio da confirmação do cadastro, verifique se o email esta correto</h1>');;
}
}

?>