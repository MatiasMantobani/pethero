<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use DAO\ReserveDAO;
use Models\Reserve as Reserve;

class ReserveController
{
    private $reserveDAO;
    private $petList;

    public function __construct()
    {
        $this->reserveDAO = new ReserveDAO();
        $this->petList = new PetController();
    }

    public function showAddView(){
        $listadoMascotas = $this->petList->GetByUserId($_SESSION['userid']);
        require_once(VIEWS_PATH."reserve-add.php");
    }

    public function Add($petid, $daterange)
    {
        // $reserveid, $transmitterid, $receiverid, , $amount, $isconfirmed, $paymentid, $ispayed, $iscompleted
        $reserve = new Reserve();

        $reserve->setReserveid($reserveid); // lo generamos en la base de datos?
        $reserve->setTransmitterid($transmitterid); // id del dueno?
        $reserve->setReceiverid($receiverid); // id del guardian seleccionado?
        $reserve->setPetid($petid);
        $reserve->setDate($daterange);
        $reserve->setAmount($amount); // varia segun el guardian?
        $reserve->setIsconfirmed(0); // por ahora lo inicializmaos como false
        $reserve->setPaymentid($paymentid); // una vez que esta confiramda la reserva?
        $reserve->setIspayed($ispayed); // por ahora lo inicializmaos como false
        $reserve->setIscompleted(0); // por ahora lo inicializmaos como false

        $this->reserveDAO->Add($reserve);
    }
}