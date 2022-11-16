<?php

namespace Controllers;

use \Exception as Exception;
use DAO\SizeDAO as SizeDAO;
use Models\Size as Size;
use Controllers\UserController as UserController;

class SizeController
{
    private $sizeDAO;

    public function __construct()
    {
        $this->sizeDAO = new SizeDAO();
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

    public function ShowAddView()
    {
        if ($this->validate() && $this->validateKeeper()) {

            $size = $this->getByUserId($_SESSION['userid']);
            require_once(VIEWS_PATH . "size-add.php");
        }
    }

    public function Add($small, $medium, $large)
    {
        if ($this->validate()) {
            try {
                $size = new Size();

                $size->setUserid($_SESSION['userid']);
                $size->setSmall($small);
                $size->setMedium($medium);
                $size->setLarge($large);

                $this->sizeDAO->Add($size);

                MessageController::add("Tamaño cargado con éxito");
                $controller = new UserController();
                $controller->ShowProfileView();
            } catch (Exception $ex) {
                HomeController::Index("Error al cargar los Tamaños aceptados");
            }
        }
    }

    public function Update($small, $medium, $large)
    {
        if ($this->validate()) {
            try {
                if ($small == false && $medium == false && $large == false) {
                    $controller = new UserController();
                    MessageController::add("Error: Debe aceptar al menos un tamaño");
                    $controller->ShowProfileView();
                } else {
                    if ($this->SizeFinder($_SESSION['userid'])) {
                        $this->sizeDAO->Remove($_SESSION['userid']);
                        $this->Add($small, $medium, $large);
                    } else {
                        $this->Add($small, $medium, $large);
                    }
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al modificar los Tamaños aceptados");
            }
        }
    }

    public function SizeFinder($userid)
    {
        if ($this->validate()) {
            try {
                return $this->sizeDAO->GetByUserid($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al encontrar el Tamaño");
            }
        }
    }

    public function getByUserId($userid)
    {
        if ($this->validate()) {
            try {
                $sizeDAO = new SizeDAO();
                $size = $sizeDAO->getByUserId($userid);
                if ($size) {
                    return $size;
                } else {
                    return null;
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al traer los Tamaños aceptados por el guardian");
            }
        }
    }

    public function Remove($userid)
    {
        if ($this->validate()) {
            try {
                $this->sizeDAO->Remove($userid);
            } catch (Exception $ex) {
                HomeController::Index("Error al eliminar el Tamaño");
            }
        }
    }
}

/*

if ($this->validate()) {
try {

} catch (Exception $ex) {
HomeController::Index("Error al ... Tamaño");
}
}

*/
