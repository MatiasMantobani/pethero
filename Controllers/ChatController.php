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


    public function validate()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }


    public function ShowAddView($receiverid)
    {
        if ($this->validate()) {
            try {
                $messages = $this->findChat($_SESSION['userid'], $receiverid);
                $imageController = new UserImageController();
                $userController = new UserController();
                $senderImage = $imageController->ShowImage($_SESSION['userid']);
                $receiverImage = $imageController->ShowImage($receiverid);
                $senderName = $userController->GetUserById($_SESSION['userid'])->getName();
                $receiverName = $userController->GetUserById($receiverid)->getName();
                $this->changeStatus($_SESSION['userid'], $receiverid, "read");
                require_once(VIEWS_PATH . "chat.php");
            } catch (Exception $ex) {
                HomeController::Index("Error al Mostrar Vista Agregar del Chat");
            }
        }
    }


    public function Add($receiverid, $text)
    {
        if ($this->validate()) {
            try {
                $chat = new Chat();

                $chat->setReceiverid($receiverid);
                $chat->setSenderid($_SESSION['userid']);
                $chat->setText($text);

                $this->chatDAO->Add($chat);

                $this->ShowAddView($receiverid);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }


    public function GetAllActiveChats()
    {
        if ($this->validate()) {
            try {
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
                    $_SESSION["message"][] = "No tienes chats para mostrar";
                    $userController = new UserController();
                    $userController->ShowProfileView();
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }



    public function changeStatus($senderid, $receiverid, $status)
    {
        if ($this->validate()) {
            try {
                $this->chatDAO->changeStatus($senderid, $receiverid, $status);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }

    
    public function findChat($sender, $receiver)
    {
        if ($this->validate()) {
            try {
                return $this->chatDAO->findChat($receiver, $sender);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }
}


/*
if ($this->validate()) {

}

try {

} catch (Exception $ex) {
    HomeController::Index("Error al ... Chat");
}

*/