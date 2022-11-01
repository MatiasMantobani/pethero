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


    public function GetById()
    {
        return $this->availableDateDAO->GetByUserid($_SESSION['userid']);
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

            $this->availableDateDAO->Add($date);
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
}
