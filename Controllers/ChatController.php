<?php

namespace Controllers;

use DAO\ChatDAO;
use DAO\MessageDAO;
use Models\Chat;
use Models\Message;

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
        $chats = $this->chatDAO->getAll(); // envio todos los chats a la vista
        require_once(VIEWS_PATH."chat.php");
    }

    public function ShowSpecificChat(){
        $chats = $this->chatDAO->getAll(); // envio todos los chats a la vista
        require_once(VIEWS_PATH."chat.php");
    }

    public function createChat($receiver){
        $chat = new Chat();

        $chat->setReceiver();
        $chat->setSender($_SESSION['userid']);
        $chat->setMessages(); // va llegar apenas se crea un chat o se lo actuliza despues?

        // un boton donde el owner podra iniciar una conversacion (con un keeper cualquiera o solo los que contrato?) ubicado en el perfil del keeper
        // evaluar si ya existe un chat entre el sender y el receiver
        $this->chatDAO->Add($chat);
    }

    public function createMessage($chatId){
        $message = new Message();

        $message->setChatidentifier($chatId);
        $message->setSender();
        //$message->setRead(); se setea automaticamente como 0 (false) en la base de datos
        $message->setText();
        //$message->setTime(); se setea automaticamente con la fecha del momento de creacion

        $this->messageDAO->Add($message);
    }

    public function markAsRead(){
        // ver como encarar esta logica y la del DAO
        $this->messageDAO->markAsRead();
    }


}