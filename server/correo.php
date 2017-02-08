<?php

require 'PHPMailer/PHPMailerAutoload.php';

class correo {

    private $host = 'mail.altamirapropiedades.cl';
    private $usuario = 'envios@altamirapropiedades.cl';
    private $password = 'envios2016';
    private $puerto = 125;
    private $mail;

    public function __construct() {
        if (!isset($this->mail)) {
            $mail = new PHPMailer;
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $this->host;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $this->usuario;                 // SMTP username
            $mail->Password = $this->password;                           // SMTP password
            $mail->Port = $this->puerto;

            $mail->setLanguage('es', 'PHPMailer/');
        }
    }
    
    public function getEmail(){
        return $this->mail;
    }
    
    public function setRemitente($correo){
        $this->mail->setFrom($correo);
    }
    
    public function agregarDest($correo){
        $this->mail->addAddress($correo);
    }
    
    public function agregarReply($correo){
        $this->mail->addReplyTo($correo);
    }
    
    public function agregarCC($correo){
        $this->mail->addCC($correo);
    }
    
    public function agregarBCC($correo){
        $this->mail->addBCC($correo);
    }   
    
    public function setHTML($valor){
        $this->mail->isHTML($valor);
    }
    
    public function setAsunto($valor){
        $this->mail->Subject($valor);
    }
    
    public function setBody($valor){
        $this->mail->Body($valor);
    }
    
    
    public function send(){
        return $this->send();
    }

}
