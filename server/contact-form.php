<?php

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isMail();                                  
$mail->setLanguage('es', 'PHPMailer/');

header('Content-type: application/json');
$email = $request->correo;
$nombre = $request->nombre;
$telefono = $request->telefono;
$asunto = $request->asunto;
$mensaje = $request->mensaje;
$operacion = $request->operacion;
$tipo = $request->tipo;

if ($operacion == "VENTA") {
    $destino = "acorrea@altamirapropiedades.cl";
} elseif ($operacion == "ARRIENDO") {
    $destino = "arriendo@altamirapropiedades.cl";
}
error_log(print_r($email, TRUE));
error_log(print_r($destino, TRUE));
error_log(print_r($operacion, TRUE));

$message = '<html><body>';
$message .= '<img src="http://www.altamirapropiedades.cl/main/img/banneremail.png" alt="Altamira Propiedades" /><br />';
$message .= '<span style="font-family:Arial, Helvetica;color:#555555;font-size:12px">' . $mensaje;
$message .= "<br /><br />";
$message .= $nombre . "<br />Tel:" . $telefono . "<br />Email:" . $email . "</span>";
$message .= "</body></html>";

$mail->setFrom('contactoweb@altamirapropiedades.cl');
$mail->addAddress($destino);
$mail->addReplyTo($email);
$mail->CharSet = "UTF-8";
$mail->addCC("contactenos@altamirapropiedades.cl");
$mail->addCC("glopez@altamirapropiedades.cl");
$mail->addCC("mcorrea@altamirapropiedades.cl");
$mail->addCC("redsocial@altamirapropiedades.cl");
if($tipo == "ENTREGUENOS"){
    $mail->addCC("entreguenos@altamirapropiedades.cl");
}

$mail->isHTML(true);
$mail->Subject = $asunto;
$mail->Body = $message;

$solicitud = $mail->send();
$res = $solicitud ? "Solicitud de envío exitosa." : $mail->ErrorInfo;

$miArray = array("message" => $res, "success" => $solicitud);
echo(json_encode($miArray));

