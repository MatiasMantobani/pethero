<?php

namespace Controllers;

use DAO\ChatDAO as ChatDAO;
use Models\Chat as Chat;
use Controllers\UserImageController as UserImageController;
use Controllers\UserController as UserController;

class ChatController
{
    private $chatDAO;

    public function __construct()
    {
        $this->chatDAO = new ChatDAO();
    }

    public function ShowAddView($receiverid){
        $messages = $this->findChat($_SESSION['userid'], $receiverid);
        $imageController = new UserImageController();
        $userController = new UserController();
        $senderImage = $imageController->ShowImage($_SESSION['userid']);
        $receiverImage = $imageController->ShowImage($receiverid);
        $senderName = $userController->GetUserById($_SESSION['userid'])->getName();
        $receiverName = $userController->GetUserById($receiverid)->getName();
        require_once(VIEWS_PATH."chat.php");
    }

    public function Add($receiverid, $text){
        $chat = new Chat();

        $chat->setReceiverid($receiverid);
        $chat->setSenderid($_SESSION['userid']);
        $chat->setText($text); // setear en vacio?

        $this->chatDAO->Add($chat);

        if($chat->getSenderid() != $_SESSION['userid']){
            $this->changeStatus($_SESSION['userid'], $receiverid, "read");
        }

        $this->ShowAddView($receiverid);
    }

    public function changeStatus($senderid, $receiverid, $status){
        // ver como encarar esta logica y la del DAO
        $this->chatDAO->changeStatus();
    }

    public function findChat($sender, $receiver){
        return $this->chatDAO->findChat($receiver, $sender);
    }
}