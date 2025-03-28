<?php 
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
session_start();
$email = $_SESSION['email'];
$nome = $_SESSION['nome'];

// Envio de e-mail
   

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "openforum246@gmail.com";
$mail->Password = "ifpu mzyq ditm bpoz ";
$codigo = rand(100000, 999999);
$mail->setFrom($email, $nome);
$mail->addAddress($email, "OpenForum");

$subject = "Verificação de Cadastro";
$message = "Olá, $nome. Para concluir o cadastro do OpenForum, utilize o código de verificação: $codigo";
$mail->Subject = $subject;
$mail->Body = $message;

if ($mail->send()) {
    echo "E-mail de verificação enviado!";
} else {
    echo "Erro ao enviar o e-mail: " . $mail->ErrorInfo;
}

?>