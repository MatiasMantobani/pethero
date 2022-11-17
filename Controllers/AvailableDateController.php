<?php

namespace Controllers;

use Controllers\MessageController as MessageController;
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
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }


    public function validateKeeper()
    {
        if ($_SESSION["type"] == "G") {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }


    // REPETIDA : cambiar a parametro null = session id
    public function GetById()
    {
        if ($this->validate()) {
            try {
                return $this->availableDateDAO->GetByUserid($_SESSION['userid']);
            } catch (Exception $ex) {
                HomeController::Index("Error al Traer Fecha Disponible");
            }
        }
    }


    // REPETIDA : cambiar a parametro null = session id
    public function GetByUserId($userid)
    {
        if ($this->validate()) {
            try {
                $availableDate = $this->availableDateDAO->GetByUserid($userid);
                if($availableDate != null){
                    return $availableDate;
                } else {
                    return null;
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al Traer Fecha Disponible");
            }
        }
    }


    public function UpdateDatesByBreed($userid, $dateStart, $dateFinish, $breedid)
    {
        if ($this->validate()) {
            try {
                $this->availableDateDAO->UpdateDatesByUserDatesAndBreed($userid, $dateStart, $dateFinish, $breedid);
            } catch (Exception $ex) {
                HomeController::Index("Error al Modificar Fecha Disponible");
            }
        }
    }


    public function ShowAddView()
    {
        if ($this->validate() && $this->validateKeeper()) {
            require_once(VIEWS_PATH . "availableDate-add.php");
        }
    }


    public function ShowAvailableDates()
    {
        if ($this->validate() && $this->validateKeeper()) {
            $fechas = $this->GetById();

            //para evitar mostrar una lista vacia
            if (count($fechas) > 0) {
                require_once(VIEWS_PATH . "availableDate-show.php");
            } else {
                MessageController::add("No tienes Fechas Disponibles para mostrar");
                $userController = new UserController();
                $userController->ShowProfileView();
            }
        }
    }


    public function CheckDate($userid, $date)
    {
        if ($this->validate()) {
            try {
                return $this->availableDateDAO->CheckDate($userid, $date);
            } catch (Exception $ex) {
                HomeController::Index("Error al Chequear Fecha Disponible");
            }
        }
    }


    public function AddMany($daterange)
    {
        if ($this->validate()) {

            try {
                $dateArray = explode(",", $daterange);

                $date1 = new DateTime($dateArray[0]);
                $date2 = new DateTime($dateArray[1]);

                while ($date1 <= $date2) {
                    $date = new AvailableDate();

                    $date->setUserid($_SESSION['userid']);
                    $date->setDate($date1->format('y-m-d'));
                    $date->setAvailable("0");

                    $flag = 0;
                    //chequeamos si date existe y no la subimos
                    if ($this->availableDateDAO->CheckDate($_SESSION['userid'], $date->getDate())) {
                        $flag = 1;
                    } else {
                        $this->availableDateDAO->Add($date);
                    }
                    $date1->modify('+1 day');
                }
                if ($flag == 1) {
                    MessageController::add("Algunas de tus fechas disponibles no se modificaron por que ya tienen reservas confirmadas");
                } else {
                    MessageController::add("Tus fechas fueron modificadas");
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al Agregar Varias Fecha Disponible");
            }
        }
    }

    public function Update($daterange)
    {
        if ($this->validate()) {

            try {
                $this->availableDateDAO->RemoveAvailablesById($_SESSION['userid']);
                $this->AddMany($daterange);
                $userController = new UserController();
                $userController->ShowProfileView();
            } catch (Exception $ex) {
                HomeController::Index("Error al Modificar Fecha Disponible");
            }
        }
    }


    public function getAvailablesListByDatesAndBreed($breed, $dateStart, $dateFinish)
    {
        if ($this->validate()) {
            try {
                return $this->availableDateDAO->GetAvailablesByRangeAndBreed($breed, $dateStart, $dateFinish);
            } catch (Exception $ex) {
                HomeController::Index("Error al Conseguir Fecha Disponible");
            }
        }
    }
}

/*
try {
} catch (Exception $ex) {
    HomeController::Index("Error al ... Fecha Disponible");
}
*/
