<?php

namespace Controllers;

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


    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "availableDate-add.php");
    }


    public function GetById()   //ACA
    {
        return $this->availableDateDAO->GetByUserid($_SESSION['userid']);
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
                //nada
                echo "no se puede estar disponible en fechas ya reservadas<br>";
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
