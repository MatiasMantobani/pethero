<?php
namespace Controllers;

use Controllers\UserController as UserController;
use DAO\MailerDAO as MailerDAO;
use Models\Mail as Mail;

class MailerController
{
    private $userController;
    private $mailerDAO;
    private $mail;

    public function __construct()
    {
        $this->userController = new UserController();
        $this->mailerDAO = new MailerDAO();
        $this->mail = new Mail();
    }

//    [ emailSend() ] Sends and email retrieving data from $userid
//    In order to deploy this component its mandatory to make the following adjustments to Xampp:
//
//    xampp/php/php.ini **************************************
//
//    [mail function]
//    For Win32 only.
//    http://php.net/smtp
//    SMTP=smtp.yourserver.com
//    http://php.net/smtp-port
//    smtp_port=587
//    sendmail_from = your_email_address_here
//    sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"
//
//    xampp/sendmail/sendmail.ini ****************************
//    smtp_server=smtp.gmail.com
//    smtp_port=587
//    error_logfile=error.log
//    debug_logfile=debug.log
//    auth_username=your_email_address_here
//    auth_password=your_password_here
//    force_sender=your_email_address_here (it's optional)

    public function emailSend($userid){

        $client = $this->userController->GetUserById($userid);
        if ($client != null){
            $this->mail->setSubject("Envio de cupon de pago");
            $this->mail->setBody("Muchas gracias por utilizar Pet Hero! Su pago fue realizado con exito.");
            $this->mail->setReceiverMail($client->getEmail());
            $this->mail->setSenderMail("pethero@kateclarkph.com");
            $this->mailerDAO->SendEmail($this->mail);
        } else {
            $_SESSION['message'] = "Error en envío de correo, compruebe la dirección de destino. ";
        }
    }

}
?>