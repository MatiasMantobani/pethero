<?php
namespace Models;

class Mail
{
    private $receiverMail;
    private $senderMail;
    private $subject;
    private $body;
    private $receiverName;
    private $amount;
    private $qrPath;

    /**
     * @return mixed
     */
    public function getReceiverMail()
    {
        return $this->receiverMail;
    }

    /**
     * @param mixed $receiverMail
     */
    public function setReceiverMail($receiverMail)
    {
        $this->receiverMail = $receiverMail;
    }

    /**
     * @return mixed
     */
    public function getSenderMail()
    {
        return $this->senderMail;
    }

    /**
     * @param mixed $senderMail
     */
    public function setSenderMail($senderMail)
    {
        $this->senderMail = $senderMail;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getReceiverName()
    {
        return $this->receiverName;
    }

    /**
     * @param mixed $receiverName
     */
    public function setReceiverName($receiverName)
    {
        $this->receiverName = $receiverName;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getQrPath()
    {
        return $this->qrPath;
    }

    /**
     * @param mixed $qrPath
     */
    public function setQrPath($qrPath)
    {
        $this->qrPath = $qrPath;
    }



}