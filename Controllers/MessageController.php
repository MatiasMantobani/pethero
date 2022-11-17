<?php

namespace Controllers;

class MessageController
{
    private static $messages = array();

    public static function validate()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }

    public static function add($message)
    {
        if(self::validate()){
            array_push(self::$messages, $message);
        }
    }

    public static function getAll()
    {
        if(self::validate()){
            return self::$messages;
        }
    }

    public static function clear()
    {
            self::$messages = array();
    }

}
