<?php

namespace Controllers;

class MessageController
{
    private static $messages = array();

    public static function add($message){
        array_push(self::$messages, $message);
    }

    public static function getAll(){
        return self::$messages;
    }

    public static function clear(){
        self::$messages = array();
    }


}
