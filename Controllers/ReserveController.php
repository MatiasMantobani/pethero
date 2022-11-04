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
use Controllers\KeeperController as KeeperController;

class ReserveController
{
    private $reserveDAO;
    private $petDAO;
    private $UserController;
    private $AvailableDateController;
    private $KeeperController;

    public function __construct()
    {
        $this->reserveDAO = new ReserveDAO();
        $this->petController = new PetController();
        $this->UserController = new UserController();
        $this->AvailableDateController = new AvailableDateController();
        $this->KeeperController = new KeeperController();
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

        //obtenemos ids de los "disponibles" (aquellos que tienen al menos una fecha en el rango del dueño)
        $AvailableDates = $this->AvailableDateController->getAvailablesListByDatesAndBreed($breed, $dateStart->format('y-m-d'), $dateFinish->format('y-m-d'));
        $pseudoAvailableUsers = array();
        $flag = 0;
        if ($AvailableDates != null) {
            foreach ($AvailableDates as $user) {
                $flag = 0;
                foreach ($pseudoAvailableUsers as $user2) {
                    if ($user->getUserid() == $user2->getUserid()) {
                        $flag = 1;
                    }
                }
                if ($flag == 0) {
                    array_push($pseudoAvailableUsers, $this->UserController->GetUserById($user->getUserid()));
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

        //se guardan los users
        $AvailableUsers = array();
        $AvailableKeepers = array();
        foreach ($pseudoAvailableUsers as $user) {
            $flag = 0;
            foreach ($availables as $date) {

                if (!($this->AvailableDateController->CheckDate($user->getUserid(), $date))) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                array_push($AvailableUsers, $user);

                //get keeper by id
                $keeper = $this->KeeperController->KeeperFinder($user->getUserid()); //da warnings de undefined geters
                var_dump($this->KeeperController->KeeperFinder($user->getUserid()));
                // var_dump($user->getUserid());
                // var_dump($keeper);
                array_push($AvailableKeepers, $keeper);

            }
        }

        //pasarle el keeper correspondiente a vista

        require_once(VIEWS_PATH . "choose-keeper.php");
    }


    public function totalAmount($daterange, $userid)
    {
        //se cuentan cuantos dias hay en daterange
        $dateArray = explode(",", $daterange);
        $firstdate = new DateTime($dateArray[0]);
        $lastdate = new DateTime($dateArray[1]);

        $interval = $firstdate->diff($lastdate);
        // echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 
        var_dump($interval);

        // $duration = new \DateInterval('P1Y');
        $intervalInSeconds = (new DateTime())->setTimeStamp(0)->add($interval)->getTimeStamp(); //chequear 
        $intervalInDays = $intervalInSeconds/86400; 
        echo $intervalInDays;

        //obtiene keeper por userid
        $keeper = $this->KeeperController->KeeperFinder($userid);

        //se le extrae el precio al keeper
        $valorxDia = $keeper->getPricing();

        //se multiplica cant dias * precio keeper
        $total = $valorxDia *  $intervalInDays;

        //se retorna cantidad total
        return $total;
    }

    public function Add($petid, $daterange, $userid)
    {
        $dateArray = explode(",", $daterange);
        $firstdate = new DateTime($dateArray[0]);
        $lastdate = new DateTime($dateArray[1]);

        $reserve = new Reserve();

        $reserve->setTransmitterid($_SESSION['userid']);
        $reserve->setReceiverid($userid);
        $reserve->setPetid($petid);
        $reserve->setFirstdate($firstdate);
        $reserve->setLastdate($lastdate);
        $reserve->setAmount(100);
        // $reserve->setAmount($this->totalAmount($daterange, $userid));

        $this->reserveDAO->Add($reserve);
    }
}
