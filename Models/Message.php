<?php

namespace Models;

class Message
{
    private $idmessage;
    private $chatidentifier; // ver como hacer la relacion de las tablas en SQL
    private $text;
    private $read;
    private $time;
    private $sender;

    /**
     * @return mixed
     */
    public function getIdmessage()
    {
        return $this->idmessage;
    }

    /**
     * @param mixed $idmessage
     */
    public function setIdmessage($idmessage)
    {
        $this->idmessage = $idmessage;
    }

    /**
     * @return mixed
     */
    public function getChatidentifier()
    {
        return $this->chatidentifier;
    }

    /**
     * @param mixed $chatidentifier
     */
    public function setChatidentifier($chatidentifier)
    {
        $this->chatidentifier = $chatidentifier;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * @param mixed $read
     */
    public function setRead($read)
    {
        $this->read = $read;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
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


}