<!--
How to send mail in PHP mailer if two factor authentication is active

Create a custom app in your Gmail security settings.

Log-in into Gmail with your account
Navigate to https://security.google.com/settings/security/apppasswords
In 'select app' choose 'custom', give it an arbitrary name and press generate
It will give you 16 chars tokens.
Use the token as password in combination with your full Gmail account and two factor authentication will not be required.


-->


<?php
// Importar as classes 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function sendEmail($nomecompleto,$destinario,$morada,$codigopostal,$pais,$cidade) {
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Instância da classe
$mail = new PHPMailer(true);
try
{

// Configurações do servidor
$mail->isSMTP(); //Define o uso de SMTP no envio
$mail->SMTPAuth = true; //Habilita a autenticação SMTP
$mail->Username = 'repauto555@gmail.com';
$mail->Password = 'tdeqltoteqpmgeme';
// Criptografia do envio SSL também é aceito
$mail->SMTPSecure = 'tls';
// Informações específicadas pelo Google
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
// Define o remetente
$mail->setFrom('repauto555@gmail.com', 'Mensagem do Site');
// Define o destinatário
$mail->addAddress($destinario, 'Admin');
$mail->addAddress('repauto555@gmail.com', 'Admin');
// Conteúdo da mensagem
$mail->isHTML(true); // Seta o formato do e-mail para aceitar conteúdo HTML
$mail->Subject = 'Dados de cliente';
$mail->Body = "Fatura";
$mail->AltBody = 'Este é o corpo da mensagem para clientes de e-mail que não reconhecem HTML';
// Enviar
$mail->send();
echo "
<script type='text/javascript'>
alert('A mensagem foi enviada!');
window.location.href = 'index.php';
</script>";

}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>