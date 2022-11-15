<?php

namespace Controllers;

use \Exception as Exception;
use Cassandra\Date;
use DAO\AvailableDateDAO as AvailableDateDAO;
use Models\AvailableDate as AvailableDate;
use Controllers\UserController as UserController;
use DateInterval;
use DateTime;

class AvailableDateController
{
    private $availableDateDAO;


    public function __construct()
    {
            $this->availableDateDAO = new AvailableDateDAO();
    }


    public function validate()
    {
        if (isset($_SESSION["userid"]) ) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }

    
    public function UpdateDatesByBreed($userid, $dateStart, $dateFinish, $breedid)
    {
        if ($this->validate()) {
            $this->availableDateDAO->UpdateDatesByUserDatesAndBreed($userid, $dateStart, $dateFinish, $breedid);
        }
    }

    public function ShowAddView()
    {
        if ($this->validate()) {
            require_once(VIEWS_PATH . "availableDate-add.php");
        }
    }

    public function ShowAvailableDates()
    {
        $fechas = $this->GetById();
        require_once(VIEWS_PATH . "availableDate-show.php");
    }


    public function GetById()
    {
        return $this->availableDateDAO->GetByUserid($_SESSION['userid']);
    }

    public function GetByUserId($userid)
    {
        return $this->availableDateDAO->GetByUserid($userid);
    }

    public function CheckDate($userid, $date)
    {
        return $this->availableDateDAO->CheckDate($userid, $date);
    }

    public function AddMany($daterange)
    {
        $dateArray = explode(",", $daterange);

        $date1 = new DateTime($dateArray[0]);
        $date2 = new DateTime($dateArray[1]);

        while ($date1 <= $date2) {
            $date = new AvailableDate();

            $date->setUserid($_SESSION['userid']);
            $date->setDate($date1->format('y-m-d'));
            $date->setAvailable("0");

            //chequeamos si date existe y no la subimos
            if ($this->availableDateDAO->CheckDate($_SESSION['userid'], $date->getDate())) {
                $_SESSION["message"][] = "Algunas de tus fechas disponibles no se modificaron por que ya tienen reservas confirmadas";
            } else {
                $this->availableDateDAO->Add($date);
            }
            $date1->modify('+1 day');
        }
    }


    public function Update($daterange)
    {
        $this->availableDateDAO->RemoveAvailablesById($_SESSION['userid']);
        $this->AddMany($daterange);
        $userController = new UserController();
        $userController->ShowProfileView();
    }

    public function getAvailablesListByDatesAndBreed($breed, $dateStart, $dateFinish)
    {
        return $this->availableDateDAO->GetAvailablesByRangeAndBreed($breed, $dateStart, $dateFinish);
    }
}
