<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use DAO\ReserveDAO;
use Models\Reserve as Reserve;
use DateInterval;
use DateTime;
use Cassandra\Date;

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
        $reserve = new Reserve();

        $reserve->setTransmitterid($_SESSION['userid']); // id del dueno?
        $reserve->setReceiverid(2); // id del guardian seleccionado?
        $reserve->setPetid($petid);
        $reserve->setAmount(100); // varia segun el guardian?

        $this->reserveDAO->Add($reserve);
    }
}