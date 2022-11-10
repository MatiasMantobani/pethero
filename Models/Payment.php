<?php
namespace Models;

class Payment
{
    private $paymentid;
    private $transmitterid;
    private $receiverid;
    private $reserveid;
    private $monto;
    private $qr;
    private $date;
    private $payed;

    /**
     * Get the value of qr
     */ 
    public function getQr()
    {
        return $this->qr;
    }

    /**
     * Set the value of qr
     *
     * @return  self
     */ 
    public function setQr($qr)
    {
        $this->qr = $qr;

        return $this;
    }

    /**
     * Get the value of monto
     */ 
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set the value of monto
     *
     * @return  self
     */ 
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get the value of reserveid
     */ 
    public function getReserveid()
    {
        return $this->reserveid;
    }

    /**
     * Set the value of reserveid
     *
     * @return  self
     */ 
    public function setReserveid($reserveid)
    {
        $this->reserveid = $reserveid;

        return $this;
    }

    /**
     * Get the value of receiverid
     */ 
    public function getReceiverid()
    {
        return $this->receiverid;
    }

    /**
     * Set the value of receiverid
     *
     * @return  self
     */ 
    public function setReceiverid($receiverid)
    {
        $this->receiverid = $receiverid;

        return $this;
    }

    /**
     * Get the value of transmitterid
     */ 
    public function getTransmitterid()
    {
        return $this->transmitterid;
    }

    /**
     * Set the value of transmitterid
     *
     * @return  self
     */ 
    public function setTransmitterid($transmitterid)
    {
        $this->transmitterid = $transmitterid;

        return $this;
    }

    /**
     * Get the value of paymentid
     */ 
    public function getPaymentid()
    {
        return $this->paymentid;
    }

    /**
     * Set the value of paymentid
     *
     * @return  self
     */ 
    public function setPaymentid($paymentid)
    {
        $this->paymentid = $paymentid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getPayed()
    {
        return $this->payed;
    }

    /**
     * @param mixed $payed
     */
    public function setPayed($payed)
    {
        $this->payed = $payed;
    }

}