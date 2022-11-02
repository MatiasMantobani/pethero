<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use DAO\ReserveDAO;
use Models\Reserve as Reserve;
use DateInterval;
use DateTime;
use Cassandra\Date;
use Controllers\AvailableDateController as AvailableDateController;
use Models\AvailableDate;
use Controllers\UserController as UserController;

class ReserveController
{
    private $reserveDAO;
    private $petDAO;

    public function __construct()
    {
        $this->reserveDAO = new ReserveDAO();
        $this->petController = new PetController();
    }

    public function showAddView()
    {
        $listadoMascotas = $this->petController->GetByUserId($_SESSION['userid']);
        require_once(VIEWS_PATH . "reserve-add.php");
    }

    public function showChooseKeeperView($petid, $daterange)
    {
        $pet = $this->petController->PetFinder($petid);
        // var_dump($pet);
        // echo "<br>";

        $breed = $pet->getBreedId();
        // var_dump($breed);
        // echo "<br>";

        //parsear atributos
        $dateArray = explode(",", $daterange);
        $dateStart = new DateTime($dateArray[0]);
        $dateFinish = new DateTime($dateArray[1]);
        
        $AvailableDateController = new AvailableDateController();
        $AvailableDates = $AvailableDateController->getAvailablesListByDatesAndBreed($breed, $dateStart->format('y-m-d'), $dateFinish->format('y-m-d'));
       
        //pasar los datos a la vista
        require_once(VIEWS_PATH . "choose-keeper.php");
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
