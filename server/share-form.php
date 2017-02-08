<?php

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isMail();                                  
$mail->setLanguage('es', 'PHPMailer/');

header('Content-type: application/json');
$remitente = $request->remitente;
$nombre = $request->nombre;
$destinatario = $request->destinatario;
$asunto = $request->asunto;
$mensaje = $request->mensaje;
$idprop = $request->idprop; 

error_log(print_r($email, TRUE));
error_log(print_r($destino, TRUE));
error_log(print_r($operacion, TRUE));

$message = '<html><body>';
$message .= '<img src="http://www.altamirapropiedades.cl/main/img/banneremail.png" alt="Altamira Propiedades" />';
$message .= '<span style="font-family:Arial, Helvetica;color:#555555;font-size:12px">' . $mensaje . '<a href="http://www.altamirapropiedades.cl/main/#view/' . $idprop . '">Haz clic aquí</a>';
$message .= "<br />";
$message .= $nombre . "</span>";
$message .= "</body></html>";

$mail->setFrom($remitente);
$mail->addAddress($destinatario);
$mail->addReplyTo($remitente);
$mail->CharSet = "UTF-8";
$mail->addCC("contactenos@altamirapropiedades.cl");
$mail->addCC("glopez@altamirapropiedades.cl");
$mail->addCC("mcorrea@altamirapropiedades.cl");
$mail->addBCC("redsocial@altamirapropiedades.cl");

$mail->isHTML(true);
$mail->Subject = $asunto;
$mail->Body = $message;

$solicitud = $mail->send();
$res = $solicitud ? "Solicitud de envío exitosa." : "No se ha podido enviar el correo.";

$miArray = array("message" => $res, "success" => $solicitud);
echo(json_encode($miArray));

