<?php
//require('PHPMailer/PHPMailerAutoload.php');//Si phpmailer est installé à la racine


$contents = '<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml" prefix="og: http://ogp.me/ns#"><head ><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
$contents .= "\r\n";
$contents .= '<style>* {margin: 0 !important; padding: 0 !important;} table {border-spacing: 0 !important; border-collapse : separate;} td,td img{vertical-align:top}table,table td{mso-table-lspace:0;mso-table-rspace:0;mso-line-height-rule:exactly; margin:0;padding:0;border:0;}td{border-collapse:collapse;}p{margin:0}a img{border:0}img{max-width:100%}.bOutF{line-height:1px;font-size:1px;}.bExtC *{line-height:100%}.identifiant a{color:#fff !important; text-decoration:none !important; </style>';
$contents .= "\r\n";
$contents .= '<style id="mb-e-f-headCss"></style></head><body style="margin: 0px; padding: 0px; background-color: rgb(255, 255, 255);" yahoo="fix" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" width="100%" bgcolor="#ffffff"><style class="yahoo-styles-fix">td,td img{vertical-align:top}table,table td{mso-table-lspace:0;mso-table-rspace:0;mso-line-height-rule:exactly; margin:0;padding:0;border:0;}td{border-collapse:collapse;}p{margin:0}a img{border:0}img{max-width:100%}.bOutF{line-height:1px;font-size:1px;}.bExtC *{line-height:100%}.identifiant a{color:#fff !important; text-decoration:none !important;}</style>';
$contents .= "\r\n";
$contents .= '<div style="width:100%!important;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="body" style="background-color: rgb(255, 255, 255); width: 100% !important; margin-top: 20px !important;" bgcolor="#ffffff"> <tbody><tr><td valign="top" align="center" style="padding: 25px 0px;"> <table border="0" cellpadding="0" cellspacing="0" class="bMTab noMinWidth" width="" style="width: calc(100% - 20px); max-width: 600px;margin: 0 10px; padding: 0; min-width: 320px;">';
$contents .= "\r\n";
$contents .= '<tbody><tr><td align="center" valign="top"><div><div><table border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%;" class="resBW-p100"><tbody> <tr><td valign="top" width="100%" bgcolor="#ffffff" style="background-color: rgb(255, 255, 255);border-top:none 0px #000000;border-right:none 0px #000000;border-bottom:none 0px #000000;border-left:none 0px #000000;">';
$contents .= "\r\n";
$contents .= '<table border="0" cellpadding="0" width="100%" cellspacing="0" height="auto" style="height: auto;"><tbody height="auto" style="height: auto;"> <tr> <td border="0" cellpadding="0" width="100%" cellspacing="0"> <table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody> <tr><td valign="top" width="100%" align="center" style="padding: 0px;"> <div><div><table border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%;" class="resBW-p100"> <tbody><tr> <td valign="top" bgcolor="#ffffff" style="background-color: rgb(255, 255, 255); border: 0px none rgb(0, 0, 0); border-radius: 0px; overflow: hidden; display: block;">';
$contents .= "\r\n";
$contents .= '<table border="0" cellpadding="0" align="center" cellspacing="0" width="100%" height="auto" style="height: auto;"> <tbody height="auto" style="height: auto;"><tr> <td valign="top" style="text-align: left; padding: 0px; font-size: 14px; color: rgb(0, 0, 0); font-weight: normal; font-style: normal; text-decoration: none; line-height: 100%;"><div style="font-family: Arial, Helvetica, sans-serif;"><div><img alt="" class=" bMImg" data-load="200" src="https://rencontresffie.fr/images/mail1/mail_header.jpg" style="width: 100%; margin: 0; border: 0; padding: 0; display: block;"></div></div></td></tr></tbody></table>';
$contents .= "\r\n";
$contents .= '</td></tr></tbody></table></div><div><table border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%; background: -moz-linear-gradient(left, #1f4e9c 0%, #3e80bf 100%); background: -webkit-linear-gradient(left, #1f4e9c 0%, #3e80bf 100%); background: linear-gradient(to right, #1f4e9c 0%, #3e80bf 100%); background: -ms-linear-gradient(left, #1f4e9c 0%, #3e80bf 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#1f4e9c\', endColorstr=\'#3e80bf\', GradientType=0 ); margin-bottom: 20px !important;" class="resBW-p100"> <tbody><tr> <td valign="top" bgcolor="transparent" style="background-color: transparent; border: 0px none rgb(0, 0, 0); border-radius: 0px; overflow: hidden; display: block;">';
$contents .= "\r\n";
$contents .= '<table border="0" cellpadding="0" align="center" cellspacing="0" width="100%" height="auto" style="height: auto;"> <tbody height="auto" style="height: auto;"><tr> <td valign="top" style="font-size: 16px; color: rgb(255, 255, 255); font-weight: bold; font-style: normal; text-decoration: none; line-height: 120%; text-align: center; padding: 20px !important; letter-spacing: 1px;"><div style="font-family: Arial, Helvetica, sans-serif;"><div>';
$contents .= "\r\n";
$contents .= $titre;
$contents .= "\r\n";
$contents .= '</div></div></td></tr></tbody></table> </td></tr></tbody></table></div><div><table border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%;" class="resBW-p100"> <tbody><tr> <td valign="top" bgcolor="#ffffff" style="background-color: rgb(255, 255, 255); border: 0px none rgb(0, 0, 0); border-radius: 0px; overflow: hidden; display: block;">';
$contents .= "\r\n";
$contents .= '<table border="0" cellpadding="0" align="center" cellspacing="0" width="100%" height="auto" style="height: auto;"> <tbody height="auto" style="height: auto;"><tr> <td valign="top" style="font-size: 12px; color: rgb(63, 63, 63); font-weight: normal; font-style: normal; text-decoration: none; line-height: 120%; text-align: left; padding: 0px 20px 20px !important; letter-spacing: 0px;"><div style="font-family: Arial, Helvetica, sans-serif;"><div><p style="MarGin-Bottom:0px !important;MarGin-Top:0px !important;text-align: justify;">';
$contents .= "\r\n";
$contents .= $texte;
$contents .= "\r\n";
$contents .= '</p></div></div></td></tr></tbody></table> </td></tr></tbody></table></div><div><table border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%;" class="resBW-p100"><tbody> <tr><td valign="top" width="100%" bgcolor="#ffffff" style="background-color: rgb(255, 255, 255);"> <table border="0" cellpadding="0" width="100%" cellspacing="0" ><tbody> <tr><td valign="top" width="100%">';
$contents .= "\r\n";
$contents .= '<table border="0" cellpadding="0" align="left" cellspacing="0" class="columns bMWit bCo5" style="width: 20.5%; height: auto; border-collapse: collapse;" height="auto" width=""> <tbody height="auto" style="height: auto;"><tr><td valign="top" width="100%" align="center" style="padding: 0px;"><div><div><table border="0" cellpadding="0" cellspacing="0" width="" style="width: 100%;" class="resBW-p100">';
$contents .= "\r\n";
$contents .= '<tbody><tr> <td valign="top" bgcolor="#ffffff" style="background-color: rgb(255, 255, 255); border: 0px none rgb(0, 0, 0); border-radius: 0px; overflow: hidden; display: block;"> <table border="0" cellpadding="0" align="center" cellspacing="0" width="100%" height="auto" style="height: auto;"> <tbody height="auto" style="height: auto;"><tr> <td valign="top" style="text-align: left; padding: 0px; font-size: 14px; color: rgb(0, 0, 0); font-weight: normal; font-style: normal; text-decoration: none; line-height: 100%;">';
$contents .= "\r\n";
$contents .= '<div style="font-family: Arial, Helvetica, sans-serif;"><div><a href="https://www.rencontresffie.fr" target="_blank"><img alt="" data-load="200" src="https://rencontresffie.fr/images/mail1/mail_logo.jpg" style="width: 100%; max-width: 100%; margin: 0; border: 0; padding: 0; display: block;" width=""></a></div></div></td></tr></tbody></table> </td></tr></tbody></table></div></div></td></tr></tbody> </table> <table border="0" cellpadding="0" align="left" cellspacing="0" class="columns bMWit bCo5" style="width: 53.5%; height: auto; border-collapse: collapse;" height="auto" width=""> <tbody height="auto" style="height: auto;"><tr>';
$contents .= "\r\n";
$contents .= '<td valign="top" width="100%" align="center" style="padding: 0px;"><div><div><table border="0" cellpadding="0" cellspacing="0" width="" style="width: 100%;" class="resBW-p100"> <tbody><tr> <td valign="top" bgcolor="#ffffff" style="background-color: rgb(255, 255, 255); border: 0px none rgb(0, 0, 0); border-radius: 0px; overflow: hidden; display: block;"> <table border="0" cellpadding="0" align="center" cellspacing="0" width="100%" height="auto" style="height: auto;"> <tbody height="auto" style="height: auto;"><tr> <td valign="top" style="text-align: left; padding: 0px; font-size: 14px; color: rgb(0, 0, 0); font-weight: normal; font-style: normal; text-decoration: none; line-height: 100%;">';
$contents .= "\r\n";
$contents .= '<div style="font-family: Arial, Helvetica, sans-serif;"><div><a href="https://rencontresffie.fr" target="_blank"><img alt="" class=" bMImg" data-load="200" src="https://rencontresffie.fr/images/mail1/mail_footer.jpg" style="width: 100%; max-width: 100%; margin: 0; border: 0; padding: 0; display: block;" width=""></a></div></div></td></tr></tbody></table> </td></tr></tbody></table></div></div></td></tr></tbody> </table> <table border="0" cellpadding="0" align="left" cellspacing="0" class="columns bMWit bCo5" style="width: 13%; height: auto; border-collapse: collapse;" height="auto" width=""> <tbody height="auto" style="height: auto;">';
$contents .= "\r\n";
$contents .= '<tr><td valign="top" width="100%" align="center" style="padding: 0px;"><div><div><table border="0" cellpadding="0" cellspacing="0" width="" style="width: 100%;" class="resBW-p100"> <tbody><tr> <td valign="top" bgcolor="#ffffff" style="background-color: rgb(255, 255, 255); overflow: hidden; display: block; border: 0px none rgb(0, 0, 0); border-radius: 0px;"> <table border="0" cellpadding="0" align="center" cellspacing="0" width="100%" height="auto" style="height: auto;"> <tbody height="auto" style="height: auto;"><tr> <td valign="top" style="text-align: left; padding: 0px; font-size: 14px; color: rgb(0, 0, 0); font-weight: normal; font-style: normal; text-decoration: none; line-height: 100%;">';
$contents .= "\r\n";
$contents .= '<tbody height="auto" style="height: auto;"><tr><td valign="top" width="100%" align="center" style="padding: 0px;"><div><div><table border="0" cellpadding="0" cellspacing="0" width="" style="width: 100%;" class="resBW-p100"> <tbody><tr> <td valign="top" bgcolor="#ffffff" style="background-color: rgb(255, 255, 255); overflow: hidden; display: block; border: 0px none rgb(0, 0, 0); border-radius: 0px;"> <table border="0" cellpadding="0" align="center" cellspacing="0" width="100%" height="auto" style="height: auto;"> <tbody height="auto" style="height: auto;"><tr> <td valign="top" style="text-align: left; padding: 0px; font-size: 14px; color: rgb(0, 0, 0); font-weight: normal; font-style: normal; text-decoration: none; line-height: 100%;">';
$contents .= "\r\n";
$contents .= '</td></tr></tbody></table> </td></tr></tbody></table></div></div></td></tr></tbody> </table> </td></tr></tbody></table> </td></tr></tbody></table></div></div></td></tr></tbody></table> </td></tr></tbody></table> </td></tr></tbody></table></div></div></td></tr></tbody></table> </td></tr></tbody></table></div></body></html>';
$contents .= "\r\n";



$mail2 = new PHPMailer;
$mail2->isSMTP();

$from = 'info@rencontresffie.fr'; // remplacer par l'email emetteur de votre domaine
$to2 = $email2;// remplacer par l'email de la personne qui recoit
$to_name2 = '';// Le nom de la personne si vous le souhaitez

$mail2->SMTPDebug = 0;// mettez a 1 ou 2 si vous souhaitez le debug
//$mail->Debugoutput = 'html';

$mail2->Host = "in.message-business.com";
$mail2->Port = 587;// vous pouvez aussi utiliser le port 465
$mail2->SMTPSecure = "tls";//si 465 mettre ssl, si 587 mettre tls

$mail2->SMTPAuth = true;
$mail2->Username = "51150";
$mail2->Password = "1535b858-5fe7-4de9-a587-5f3828aa36fd";

$mail->setFrom($from, 'Rencontres FFIE 2020');
$mail2->addAddress($to2, $to_name2);

$mail2->Subject = utf8_decode($objet2);// sujet du mail
$mail2->msgHTML(utf8_decode($contents2));// message html
//Si vous souhaitez avoir un message non html en plus de l'html
//$mail->AltBody = 'Message alternatif pour les clients sans html';

//$mail2->send();
?>
