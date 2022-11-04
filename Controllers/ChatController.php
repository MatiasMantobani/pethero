<?php

namespace Controllers;

use DAO\ChatDAO;
use DAO\MessageDAO;

class ChatController
{
    private $chatDAO;
    private $messageDAO;

    public function __construct()
    {
        $this->chatDAO = new ChatDAO();
        $this->messageDAO = new MessageDAO();
    }

    public function ShowAddView(){
        // enviar todos los chats que le pertenecen al usuario logueado
        require_once(VIEWS_PATH."chat.php");
    }

    public function createChat(){
        // un boton donde el owner podra iniciar una conversacion (con un keeper cualquiera o solo los que contrato?) ubicado en el perfil del keeper
        // evaluar si ya existe un chat entre el sender y el receiver
    }

    public function createMessage(){

    }

    public function markAsRead(){
        // cambiar el atributo read de Message
    }


}