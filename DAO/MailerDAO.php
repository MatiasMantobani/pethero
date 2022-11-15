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
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
