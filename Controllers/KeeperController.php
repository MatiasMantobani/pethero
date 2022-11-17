<?php

namespace Controllers;

use \Exception as Exception;
use DAO\KeeperDAO as KeeperDAO;
use Models\Keeper as Keeper;

class KeeperController
{
    private $keeperDAO;

    public function __construct()
    {
        $this->keeperDAO = new KeeperDAO();
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


    public function Add($userid)
    {
        if ($this->validate()) {
            try {
                $keeper = new Keeper();
                $keeper->setUserid($userid);

                $this->keeperDAO->Add($keeper);

                return $this->getByUserId($userid);  //solo se usa una vez al crear perfil
            } catch (Exception $ex) {
                HomeController::Index("Error al Agregar Guardian");
            }
        }
    }


    public function ShowUpdatePricingView()
    {
        if ($this->validate() && $this->validateKeeper()) {
            try {
                $keeper = $this->getByUserId($_SESSION['userid']);
                require_once(VIEWS_PATH . "pricing-update.php");
            } catch (Exception $ex) {
                HomeController::Index("Error al Modificar Guardian");
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

                    MessageController::add("Tarifa modificada con éxito");
                    $controller->ShowProfileView();
                } else {
                    MessageController::add("Tarifa: ingrese un importe mayor");
                    $controller->ShowProfileView();
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al Modificar Salario de Guardian");
            }
        }
    }


    public function getPricingByUserId($userid)
    {
        if ($this->validate()) {
            try {
                return $this->getByUserId($userid)->getPricing();
            } catch (Exception $ex) {
                HomeController::Index("Error al Conseguir Salario de Guardian");
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

                $this->keeperDAO->UpdateStatus($keeper);

                //MessageController::add("El usuario fue actualizado con éxito");
                //$controller = new UserController();
                //$controller->ShowProfileView();
            } catch (Exception $ex) {
                HomeController::Index("Error al Modificar Estado de Guardian");
            }
        }
    }


    public function GetAll()
    {
        if ($this->validate()) {
            try {
                return $this->keeperDAO->GetAll();
            } catch (Exception $ex) {
                HomeController::Index("Error al Conseguir todos los Guardianes");
            }
        }
    }


    public function KeeperFinderByUserId($userid)
    {
        if ($this->validate()) {
            try {
                return $this->keeperDAO->GetByUserId($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al Encontrar Guardian");
            }
        }
    }


    public function KeeperFinderByKeeperId($keeperid)
    {
        if ($this->validate()) {
            try {
                return $this->keeperDAO->GetByKeeperId($keeperid);
            } catch (Exception $ex) {
                HomeController::Index("Error al Encontrar Guardian");
            }
        }
    }


    public function getByKeeperId($keeperid)
    {
        if ($this->validate()) {
            try {
                return $this->keeperDAO->GetByKeeperId($keeperid);
            } catch (Exception $ex) {
                HomeController::Index("Error al Encontrar Guardian");
            }
        }
    }


    public function getByUserId($userid)
    {
        if ($this->validate()) {
            try {
                return $this->keeperDAO->GetByUserId($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al Encontrar Guardian");
            }
        }
    }
}
