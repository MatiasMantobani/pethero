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
    private $UserController;
    private $AvailableDateController;

    public function __construct()
    {
        $this->reserveDAO = new ReserveDAO();
        $this->petController = new PetController();
        $this->UserController = new UserController();
        $this->AvailableDateController = new AvailableDateController();
    }

    public function showAddView()
    {
        $listadoMascotas = $this->petController->GetByUserId($_SESSION['userid']);
        require_once(VIEWS_PATH . "reserve-add.php");
    }

    public function showChooseKeeperView($petid, $daterange)
    {
        $pet = $this->petController->PetFinder($petid);

        $breed = $pet->getBreedId();

        //parseo atributos
        $dateArray = explode(",", $daterange);
        $dateStart = new DateTime($dateArray[0]);
        $dateFinish = new DateTime($dateArray[1]);

        //obtenemos ids de guardianes "disponibles" (aquellos que tienen al menos una fecha en el rango del dueño)
        $AvailableDates = $this->AvailableDateController->getAvailablesListByDatesAndBreed($breed, $dateStart->format('y-m-d'), $dateFinish->format('y-m-d'));
        $PseudoAvailableKeepers = array();
        $flag = 0;
        if ($AvailableDates != null) {
            foreach ($AvailableDates as $keeper) {
                $flag = 0;
                foreach ($PseudoAvailableKeepers as $keeper2) {
                    if ($keeper->getUserid() == $keeper2->getUserid()) {
                        $flag = 1;
                    }
                }
                if ($flag == 0) {
                    array_push($PseudoAvailableKeepers, $this->UserController->GetUserById($keeper->getUserid()));
                }
            }
        }

        //obtenemos todos los dias marcados por el dueño
        $availables = array();
        while ($dateStart <= $dateFinish) {
            $date1 = new DateTime();
            $date1 = $dateStart;
            $date2 = $date1->format('Y-m-d');
            array_push($availables, $date2);
            $dateStart->modify('+1 day');
        }

        //se guardan los ids de los keepers
        $AvailableKeepers = array();
        foreach ($PseudoAvailableKeepers as $keeper) {
            $flag = 0;
            foreach ($availables as $date) {

                if (!($this->AvailableDateController->CheckDate($keeper->getUserid(), $date))) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                array_push($AvailableKeepers, $keeper);
            }
        }

        require_once(VIEWS_PATH . "choose-keeper.php");
    }


    public function totalAmount($daterange, $keeperid)
    {
        //se cuentan cuantos dias hay en daterange
        //se trae el keeper por id
        //se le extrae el precio al keeper
        //se multiplica cant dias * precio keeper
        //se retorna cantidad total
    }



    public function Add($petid, $daterange, $keeperid)
    {
        $dateArray = explode(",", $daterange);
        $firstdate = new DateTime($dateArray[0]);
        $lastdate = new DateTime($dateArray[1]);

        // $reserve->setAmount(totalAmount($daterange, $keeperid));

        $reserve = new Reserve();

        $reserve->setTransmitterid($_SESSION['userid']);
        $reserve->setReceiverid($keeperid);
        $reserve->setPetid($petid);
        $reserve->setFirstdate($firstdate);
        $reserve->setLastdate($lastdate);
        $reserve->setAmount(100);

        $this->reserveDAO->Add($reserve);
    }
}
