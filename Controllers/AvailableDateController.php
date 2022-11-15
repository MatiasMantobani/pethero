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


    // REPETIDA : cambiar a parametro null = session id
    public function GetById()
    {
        if ($this->validate()) {
            try {
                return $this->availableDateDAO->GetByUserid($_SESSION['userid']);
            } catch (Exception $ex) {
                // var_dump($ex);
                $_SESSION["message"] = "Error al Traer Fecha Disponible";
            }
        }
    }


    // REPETIDA : cambiar a parametro null = session id
    public function GetByUserId($userid)
    {
        if ($this->validate()) {
            try {
                return $this->availableDateDAO->GetByUserid($userid);
            } catch (Exception $ex) {
                // var_dump($ex);
                $_SESSION["message"] = "Error al Traer De Fecha Disponible";
            }
        }
    }


    public function validate()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }


    public function UpdateDatesByBreed($userid, $dateStart, $dateFinish, $breedid)
    {
        if ($this->validate()) {
            try {
                $this->availableDateDAO->UpdateDatesByUserDatesAndBreed($userid, $dateStart, $dateFinish, $breedid);
            } catch (Exception $ex) {
                // var_dump($ex);
                $_SESSION["message"] = "Error al Modificar Fecha Disponible";
            }
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
        if ($this->validate()) {
            $fechas = $this->GetById();
            require_once(VIEWS_PATH . "availableDate-show.php");
        }
    }


    public function CheckDate($userid, $date)
    {
        if ($this->validate()) {
            try {
                return $this->availableDateDAO->CheckDate($userid, $date);
            } catch (Exception $ex) {
                // var_dump($ex);
                $_SESSION["message"] = "Error al Chequear Fecha Disponible";
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

                    //chequeamos si date existe y no la subimos
                    if ($this->availableDateDAO->CheckDate($_SESSION['userid'], $date->getDate())) {
                        $_SESSION["message"][] = "Algunas de tus fechas disponibles no se modificaron por que ya tienen reservas confirmadas";
                    } else {
                        $this->availableDateDAO->Add($date);
                    }
                    $date1->modify('+1 day');
                }
            } catch (Exception $ex) {
                // var_dump($ex);
                $_SESSION["message"] = "Error al Agregar Varias Fechas Disponibles";
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
                // var_dump($ex);
                // $_SESSION["message"] = "Error al Modificar Fecha Disponible";
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
                // var_dump($ex);
                $_SESSION["message"] = "Error al Conseguir Fechas Disponibles";
            }
        }
    }
}

/*
try {
} catch (Exception $ex) {
    // var_dump($ex);
    HomeController::Index("Error al ... De Fecha Disponible");
}
*/
