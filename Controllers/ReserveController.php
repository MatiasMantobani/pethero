<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use DAO\ReserveDAO;
use Models\Reserve as Reserve;

class ReserveController
{
    private $reserveDAO;

    public function __construct()
    {
        $this->reserveDAO = new ReserveDAO();
    }

    public function showAddView(){
        require_once(VIEWS_PATH."reserve-add.php");
    }

    public function Add($reserveid, $transmitterid, $receiverid, $petid, $date, $amount, $isconfirmed, $paymentid, $ispayed, $iscompleted)
    {
        $reserve = new Reserve();

        $reserve->setReserveid($reserveid);
        $reserve->setTransmitterid($transmitterid);
        $reserve->setReceiverid($receiverid);
        $reserve->setPetid($petid);
        $reserve->setDate($date);
        $reserve->setAmount($amount);
        $reserve->setIsconfirmed($isconfirmed);
        $reserve->setPaymentid($paymentid);
        $reserve->setIspayed($ispayed);
        $reserve->setIscompleted($iscompleted);

        $this->reserveDAO->Add($reserve);
    }
}