<?php
require('../PHPMailer/PHPMailerAutoload.php');//Si phpmailer est installé à la racine

$mail = new PHPMailer;
$mail->isSMTP();

$from = 'convention@socoda.com'; // remplacer par l'email emetteur de votre domaine
$to = 'a.kerros@arep.co.com';// remplacer par l'email de la personne qui recoit
$to_name = 'Adrien';// Le nom de la personne si vous le souhaitez

$mail->SMTPDebug = 0;// mettez a 1 ou 2 si vous souhaitez le debug
//$mail->Debugoutput = 'html';

$mail->Host = "in.message-business.com";
$mail->Port = 587;// vous pouvez aussi utiliser le port 465
$mail->SMTPSecure = "tls";//si 465 mettre ssl, si 587 mettre tls

$mail->SMTPAuth = true;
$mail->Username = "51150";
$mail->Password = "1535b858-5fe7-4de9-a587-5f3828aa36fd";

$mail->setFrom($from, '');
$mail->addAddress($to, $to_name);

$mail->Subject = 'testok';// sujet du mail
$mail->msgHTML('hello world');// message html
//Si vous souhaitez avoir un message non html en plus de l'html
//$mail->AltBody = 'Message alternatif pour les clients sans html';

// $mail->send();

echo "hello";
?>
