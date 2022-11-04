<?php

namespace Models;

class Chat
{
    private $idchat;
    private $sender;
    private $receiver;
    private $messages;

    /**
     * @return mixed
     */
    public function getIdchat()
    {
        return $this->idchat;
    }

    /**
     * @param mixed $idchat
     */
    public function setIdchat($idchat)
    {
        $this->idchat = $idchat;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param mixed $receiver
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param mixed $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    } // arreglo de Message


}