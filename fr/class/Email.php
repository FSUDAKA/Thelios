<?php
require_once('PHPMailer/PHPMailerAutoload.php');//Si phpmailer est installé à la racine


$contents = '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml" prefix="og: http://ogp.me/ns#"><head ><meta charset="UTF-8"><meta name="format-detection" content="telephone=no"> <meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title></title>';
$contents .= "\r\n";
$contents .= '<style>td,td img{vertical-align:top}table,table td{mso-table-lspace:0;mso-table-rspace:0;mso-line-height-rule:exactly; margin:0;padding:0;border:0;}td{border-collapse:collapse;}p{margin:0}a img{border:0}img{max-width:100%}.bOutF{line-height:1px;font-size:1px;}.bExtC *{line-height:100%}</style>';
$contents .= "\r\n";
$contents .= '<!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings></xml><![endif]-->';
$contents .= "\r\n";
$contents .= '<style id="responsive_rules_compiled">@media screen and (max-width:480px) {img{height:auto !important;}img.bMImg{width:100%!important;max-width:100%!important;min-width:100%!important;height:auto !important;}table,table td{-moz-box-sizing:border-box;box-sizing:border-box;}table.bMTab {width:90%!important;min-width:90%!important;}table.bMWit,table.bMWit > tbody,table.bMWit > tbody > tr,table.bMWit > tbody > tr > td, table.bMWit > tbody > tr > th{display:block!important;width:100%!important;min-width:100%!important;}';
$contents .= "\r\n";
$contents .= '.bMLef{text-align:left!important}.bMRig{text-align:right!important}.bMCen{text-align:center!important}.bMJus{text-align:justify!important}.bMHIm img{display:none!important;} .bMHid {display:none!important;}.bMSho {overflow:visible!important;float:none!important;display:block!important;line-height:100%!important;max-height:100%!important;font-size:100%!important;opacity:1!important;}td.bBOut{border:none!important;}.bMBLe{float:left;}.bMBRi{float:right;}a.w_100_parent{min-width:0px !important;}table.resBW-p100{width:100% !important;}}</style>';
$contents .= "\r\n";
$contents .= '<style id="mb-e-f-headCss">a.h_bg_0073cf:hover{background:#0073cf !important;} a.h_b_solid_1px_0073cf:hover{border:solid 1px #0073cf !important;} </style></head>';
$contents .= "\r\n";
$contents .= '<body style="margin: 0px; padding: 0px; background-color: rgb(255, 255, 255);" yahoo="fix" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" width="100%" bgcolor="#ffffff">';
$contents .= "\r\n";
$contents .= '<style class="yahoo-styles-fix">td,td img{vertical-align:top}table,table td{mso-table-lspace:0;mso-table-rspace:0;mso-line-height-rule:exactly; margin:0;padding:0;border:0;}td{border-collapse:collapse;}p{margin:0}a img{border:0}img{max-width:100%}.bOutF{line-height:1px;font-size:1px;}.bExtC *{line-height:100%}@media screen and (max-width:480px) {img{height:auto !important;}img.bMImg{width:100%!important;max-width:100%!important;min-width:100%!important;height:auto !important;}';
$contents .= "\r\n";
$contents .= 'table,table td{-moz-box-sizing:border-box;box-sizing:border-box;}table.bMTab {width:90%!important;min-width:90%!important;}table.bMWit,table.bMWit > tbody,table.bMWit > tbody > tr,table.bMWit > tbody > tr > td, table.bMWit > tbody > tr > th{display:block!important;width:100%!important;min-width:100%!important;}.bMLef{text-align:left!important}.bMRig{text-align:right!important}.bMCen{text-align:center!important}.bMJus{text-align:justify!important}.bMHIm img{display:none!important;} .bMHid {display:none!important;}';
$contents .= "\r\n";
$contents .= '.bMSho {overflow:visible!important;float:none!important;display:block!important;line-height:100%!important;max-height:100%!important;font-size:100%!important;opacity:1!important;}td.bBOut{border:none!important;}.bMBLe{float:left;}.bMBRi{float:right;}a.w_100_parent{min-width:0px !important;}table.resBW-p100{width:100% !important;}}a.h_bg_0073cf:hover{background:#0073cf !important;} a.h_b_solid_1px_0073cf:hover{border:solid 1px #0073cf !important;} </style>';
$contents .= "\r\n";
$contents .= '<div style="width:100%!important;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="body" style="background-color: rgb(247, 247, 247); width: 100% !important;" bgcolor="#f7f7f7"> <tbody><tr><td valign="top" align="center" style="padding: 25px 0px;"> <table border="0" cellpadding="0" cellspacing="0" class="bMTab noMinWidth" width="680" style="width: 680px; padding: 0; min-width: 320px;"> <tbody><tr><td align="center" valign="top"><div><div><table border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%;" class="resBW-p100">';
$contents .= "\r\n";
$contents .= '<tbody><tr> <td valign="top" bgcolor="#ffffff" style="background-color: rgb(255, 255, 255); border: 0px none rgb(0, 0, 0); overflow: hidden; display: block; border-radius: 6px 6px 0px 0px;"> <table border="0" cellpadding="0" align="center" cellspacing="0" width="100%" height="auto" style="height: auto;"> <tbody height="auto" style="height: auto;"><tr> <td valign="top" style="text-align: left; padding: 0px; font-size: 14px; color: rgb(0, 0, 0); font-weight: normal; font-style: normal; text-decoration: none; line-height: 100%;"><div style="font-family: Arial, Helvetica, sans-serif;"><div>';
$contents .= "\r\n";
$contents .= '<img alt="" class=" bMImg" data-load="200" height="52" src="https://services.message-business.com/v3/Front/contents/2/150/51150/Files/thelios.png" style="width: 680px; max-width: 100%; height: 52px;" width="680"></div></div></td> </tr> </tbody></table> </td> </tr> </tbody></table></div><div><table border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%;" class="resBW-p100"> <tbody><tr> <td valign="top" bgcolor="#ffffff" style="background-color: rgb(255, 255, 255); border: 0px none rgb(0, 0, 0); border-radius: 0px; overflow: hidden; display: block;"> <table border="0" cellpadding="0" align="center" cellspacing="0" width="100%" height="auto" style="height: auto;"> <tbody height="auto" style="height: auto;"><tr>';
$contents .= "\r\n";
$contents .= '<td valign="top" style="font-size: 15px; color: rgb(0, 0, 0); font-weight: normal; font-style: normal; text-decoration: none; line-height: 120%; text-align: left; padding: 30px;"><div style="font-family: Arial, Helvetica, sans-serif;"><div><p style="MarGin:0px auto !important;">';
$contents .= "\r\n";
$contents .= $texte;
$contents .= "\r\n";
$contents .= '<br><br><img alt="" data-load="200" height="45" src="https://services.message-business.com/v3/Front/contents/2/150/51150/Files/logo-thelios.png" style="width: 63px; max-width: 100%; height: 45px;" width="63"><br>Thélios SpA<br>Zona Industriale Villanova, 16<br>32013 Longarone (BL) - Italy<br>Mob.(+33) 6 73 22 61 62<br>events@thelios.com</p></div></div></td> </tr> </tbody></table> </td> </tr> </tbody></table></div></div></td></tr></tbody></table> </td></tr></tbody></table></div></body></html>';



$mail = new PHPMailer;
$mail->isSMTP();

$from = 'noreply@challenge-pro.fr'; // remplacer par l'email emetteur de votre domaine
$to = $email;// remplacer par l'email de la personne qui recoit
$to_name = '';// Le nom de la personne si vous le souhaitez

$mail->SMTPDebug = 0;// mettez a 1 ou 2 si vous souhaitez le debug
//$mail->Debugoutput = 'html';

$mail->Host = "in.message-business.com";
$mail->Port = 587;// vous pouvez aussi utiliser le port 465
$mail->SMTPSecure = "tls";//si 465 mettre ssl, si 587 mettre tls

$mail->SMTPAuth = true;
$mail->Username = "51150";
$mail->Password = "1535b858-5fe7-4de9-a587-5f3828aa36fd";

$mail->setFrom($from, 'THELIOS');
$mail->addAddress($to, $to_name);

//$mail->AddBCC("a.kerros@arep.co.com", "");

$mail->Subject = utf8_decode($objet);// sujet du mail
$mail->msgHTML(utf8_decode($contents));// message html
//Si vous souhaitez avoir un message non html en plus de l'html
//$mail->AltBody = 'Message alternatif pour les clients sans html';

$mail->send();
?>
