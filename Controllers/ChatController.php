<?php

namespace Controllers;

use \Exception as Exception;
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

    public function ShowAddView($receiverid)
    {
        $messages = $this->findChat($_SESSION['userid'], $receiverid);
        $imageController = new UserImageController();
        $userController = new UserController();
        $senderImage = $imageController->ShowImage($_SESSION['userid']);
        $receiverImage = $imageController->ShowImage($receiverid);
        $senderName = $userController->GetUserById($_SESSION['userid'])->getName();
        $receiverName = $userController->GetUserById($receiverid)->getName();
        $this->changeStatus($_SESSION['userid'], $receiverid, "read");
        require_once(VIEWS_PATH . "chat.php");
    }

    public function Add($receiverid, $text)
    {
        $chat = new Chat();

        $chat->setReceiverid($receiverid);
        $chat->setSenderid($_SESSION['userid']);
        $chat->setText($text);

        $this->chatDAO->Add($chat);

        $this->ShowAddView($receiverid);
    }

    public function GetAllActiveChats()
    {
        $allChats = $this->chatDAO->GetAllActiveChats($_SESSION['userid']);
        $finalList = array();
        foreach ($allChats as $chat) {
            if ($chat->getReceiverid() != $_SESSION['userid']) {
                array_push($finalList, $chat->getReceiverid());
            }
            if ($chat->getSenderid() != $_SESSION['userid']) {
                array_push($finalList, $chat->getSenderid());
            }
        }
        $list = array_unique($finalList);
        $userList = array();
        $userController = new UserController();
        foreach ($list as $userid) {
            array_push($userList, $userController->GetUserById($userid));
        }

        //para evitar mostrar una lista vacia
        if (count($userList) > 0) {
            require_once(VIEWS_PATH . "chat-list.php");
        } else {
            $_SESSION["message"] = "No tienes chats para mostrar";
            $userController = new UserController();
            $userController->ShowProfileView();
        }



        
    }

    public function changeStatus($senderid, $receiverid, $status)
    {
        $this->chatDAO->changeStatus($senderid, $receiverid, $status);
    }

    public function findChat($sender, $receiver)
    {
        return $this->chatDAO->findChat($receiver, $sender);
    }
}
