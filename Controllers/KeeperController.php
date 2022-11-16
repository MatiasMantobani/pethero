<?php

namespace Controllers;

use \Exception as Exception;
use DAO\KeeperDAO as KeeperDAO;
use Models\Keeper as Keeper;
use Controllers\AdressController as AdressController;
use Controllers\AvailableDateController as AvailableDateController;

class KeeperController
{
    private $keeperDAO;

    private $adressController;
    private $AvailableController;

    public function __construct()
    {
        $this->keeperDAO = new KeeperDAO();

        $this->adressController = new AdressController();
        $this->AvailableController = new AvailableDateController();
    }


    public function validate()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }


    public function Add($userid)
    {
        if ($this->validate()) {
            try {
                $keeper = new Keeper();
                $keeper->setUserid($userid);

                $this->keeperDAO->Add($keeper);

                return $this->getByUserId($userid);  //solo se usa una vez al crear perfil
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }


    public function ShowUpdatePricingView()
    {
        if ($this->validate()) {
            try {
                $keeper = $this->getByUserId($_SESSION['userid']);
                require_once(VIEWS_PATH . "pricing-update.php");
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }


    public function UpdatePricing($pricing)
    {
        if ($this->validate()) {
            try {

                $controller = new UserController();

                if ($pricing > 0) {
                    $keeper = new Keeper();
                    $keeper->setUserid($_SESSION['userid']);
                    $keeper->setPricing($pricing);

                    $this->keeperDAO->UpdatePricing($keeper);

                    $this->UpdateStatus(1);

                    $_SESSION['message'][] = "Tarifa modificada con éxito";
                    $controller->ShowProfileView();
                } else {
                    $_SESSION['message'][] = "Tarifa: ingrese un importe mayor";
                    $controller->ShowProfileView();
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }


    public function getPricingByUserId($userid)
    {
        if ($this->validate()) {
            try {
                return $this->getByUserId($userid)->getPricing();
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }


    public function UpdateStatus($status)
    {
        if ($this->validate()) {
            try {
                $keeper = new Keeper();
                $keeper->setUserid($_SESSION['userid']);
                $keeper->setStatus($status);

                $this->keeperDAO->UpdateStatus($keeper);;

                $_SESSION['message'][] = "El usuario fue actualizado con éxito";
                $controller = new UserController();
                $controller->ShowProfileView();
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }


    public function GetAll()
    {
        if ($this->validate()) {
            try {
                return $this->keeperDAO->GetAll();
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }


    public function KeeperFinderByUserId($userid)
    {
        if ($this->validate()) {
            try {
                return $this->keeperDAO->GetByUserId($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }


    public function KeeperFinderByKeeperId($keeperid)
    {
        if ($this->validate()) {
            try {
                return $this->keeperDAO->GetByKeeperId($keeperid);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }


    public function getByKeeperId($keeperid)
    {
        if ($this->validate()) {
            try {
                return $this->keeperDAO->GetByKeeperId($keeperid);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }


    public function getByUserId($userid)
    {
        if ($this->validate()) {
            try {
                return $this->keeperDAO->GetByUserId($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al ... Chat");
            }
        }
    }
}

/*
if ($this->validate()) {

}

try {

} catch (Exception $ex) {
    HomeController::Index("Error al ... Chat");
}

*/