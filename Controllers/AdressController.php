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


    public function Update($street, $number, $floor, $department, $postalcode)
    {
        try {
            if ($this->AdressFinder($_SESSION['userid'])) {
                $this->adressDAO->Update($_SESSION['userid'], $street, $number, $floor, $department, $postalcode);

                $_SESSION['message'] = "Domicilio modificado con exito<br>";
            } else {
                $this->Add($street, $number, $floor, $department, $postalcode);
            }
        } catch (Exception $ex) {
            // var_dump($ex);   //se puede
            $_SESSION["message"] = "Error al Modificar la Direccion";
        }
        $controller = new UserController();
        $controller->ShowProfileView();
    }


    public function ShowAddView()
    {
        try {
            $adress2 = $this->getByUserId($_SESSION['userid']);
            require_once(VIEWS_PATH . "adress-add.php");
        } catch (Exception $ex) {
            // var_dump($ex);
            $_SESSION["message"] = "Error al mostrar la Vista de Agregar Dirección";
        }
    }


    public function ShowListView()
    {
        try {
            $adressList = $this->adressDAO->GetAll();
            require_once(VIEWS_PATH . "adress-list.php");
        } catch (Exception $ex) {
            // var_dump($ex);
            $_SESSION["message"] = "Error al Mostrar la Lista de Dirección";
        }
    }


    public function Add($street, $number, $floor, $department, $postalcode)
    {
        try {
            $adress = new Adress();

            $adress->setUserid($_SESSION['userid']);
            $adress->setStreet($street);
            $adress->setNumber($number);
            $adress->setFloor($floor);
            $adress->setDepartment($department);
            $adress->setPostalcode($postalcode);

            $this->adressDAO->Add($adress);

            $controller = new UserController();
            $controller->ShowProfileView();
        } catch (Exception $ex) {
            // var_dump($ex);
            $_SESSION["message"] = "Error al Agregar Direccion";
        }
    }


    public function AdressFinder($userid)
    {
        try {
            return $this->adressDAO->GetByUserid($userid);
        } catch (Exception $ex) {
            // var_dump($ex);
            $_SESSION["message"] = "Error al Ecnontrar Direccion";
        }
    }


    public function getByUserId($userid)
    {
        try {
            $adressDAO = new AdressDAO();
            $adress = $adressDAO->getByUserId($userid);
            if ($adress) {
                return $adress;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            // var_dump($ex);
            $_SESSION["message"] = "Error al Conseguir por Usuario en Direccion";
        }
    }


    public function Remove($userid)
    {
        try {
            $this->adressDAO->Remove($userid);
        } catch (Exception $ex) {
            // var_dump($ex);
            $_SESSION["message"] = "Error al Remover Direccion";
        }
    }
}

/*
try {
        } catch (Exception $ex) {
            // var_dump($ex);
            $_SESSION["message"] = "Error al ... De Direccion";
        }

*/