<?php

namespace Models;

class Chat
{
    private $idmessage;
    private $receiverid;
    private $text;
    private $status;
    private $time;
    private $senderid;

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
    public function getReceiverid()
    {
        return $this->receiverid;
    }

    /**
     * @param mixed $receiverid
     */
    public function setReceiverid($receiverid)
    {
        $this->receiverid = $receiverid;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
    public function getSenderid()
    {
        return $this->senderid;
    }

    /**
     * @param mixed $senderid
     */
    public function setSenderid($senderid)
    {
        $this->senderid = $senderid;
    }

}