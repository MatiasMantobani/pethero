<?php

namespace DAO;

use \Exception as Exception;
use Models\Mail as Mail;

class MailerDAO
{
    public function SendEmail(Mail $mail)
    {
        try {
            $receiver = $mail->getReceiverMail();
            $subject = $mail->getSubject();
            $body = $mail->getBody();
            $sender = "From:" . $mail->getSenderMail();
            if (mail($receiver, $subject, $body, $sender)) {
                $_SESSION['message'] = "Correo enviado correctamente";
            } else {
                $_SESSION['message'] = "Error en envío de correo, compruebe la dirección de destino. ";
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
