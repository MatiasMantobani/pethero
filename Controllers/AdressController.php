<?php

namespace Controllers;

use \Exception as Exception;
use DAO\AdressDAO as AdressDAO;
use Models\Adress as Adress;
use Controllers\UserController as UserController;

class AdressController
{
    private $adressDAO;


    public function __construct()
    {
        $this->adressDAO = new AdressDAO();
    }


    public function validate()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }


    public function AdressFinder($userid)
    {
        if ($this->validate()) {
            return $this->adressDAO->GetByUserid($userid);
        }
    }


    public function Update($street, $number, $floor, $department, $postalcode)
    {
        if ($this->validate()) {
            try {
                if ($this->AdressFinder($_SESSION['userid'])) {
                    $this->adressDAO->Update($_SESSION['userid'], $street, $number, $floor, $department, $postalcode);

                    $_SESSION['message'][] = "Domicilio modificado con exito";
                } else {
                    $this->Add($street, $number, $floor, $department, $postalcode);
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al Modificar Direccion");
            }
            $controller = new UserController();
            $controller->ShowProfileView();
        }
    }


    public function ShowAddView()
    {
        if ($this->validate()) {
            $adress2 = $this->getByUserId($_SESSION['userid']);
            require_once(VIEWS_PATH . "adress-add.php");
        }
    }


    public function Add($street, $number, $floor, $department, $postalcode)
    {
        if ($this->validate()) {
            try {
                $adress = new Adress();

                $adress->setUserid($_SESSION['userid']);
                $adress->setStreet($street);
                $adress->setNumber($number);
                $adress->setFloor($floor);
                $adress->setDepartment($department);
                $adress->setPostalcode($postalcode);

                $this->adressDAO->Add($adress);
            } catch (Exception $ex) {
                HomeController::Index("Error al Cargar Direccion");
            }
            $controller = new UserController();
            $controller->ShowProfileView();
        }
    }


    public function getByUserId($userid)
    {
        if ($this->validate()) {
            try {
                $adressDAO = new AdressDAO();
                $adress = $adressDAO->getByUserId($userid);
                if ($adress) {
                    return $adress;
                } else {
                    return null;
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al Obtener Direccion");
            }
        }
    }


    public function Remove($userid)
    {
        if ($this->validate()) {
            try {
                $this->adressDAO->Remove($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al Remover Direccion");
            }
        }
    }
}

/*

if ($this->validate()) {
            
        }


        // Si solo llama a vista con requiere no lleva try-catch
        // Si llama directa o indirectamente a un metodo de algun DAO lleva try-catch
        // Si llama a otro metodo que ya tiene un try-catch no lleva try-catch
try {
        } catch (Exception $ex) {
            HomeController::Index("Error al ... Direccion");
        }

*/