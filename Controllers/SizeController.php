<?php
namespace Controllers;

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

    public function ShowAddView()
    {
        $size = $this->getByUserId($_SESSION['userid']);
        require_once(VIEWS_PATH."size-add.php");
    }

    public function Add($small, $medium, $large)
    {
        $size = new Size();

        $size->setUserid($_SESSION['userid']);
        $size->setSmall($small);
        $size->setMedium($medium);
        $size->setLarge($large);

        $this->sizeDAO->Add($size);

        $controller = new UserController();
        $controller->ShowProfileView();
    }

    public function Update($small, $medium, $large){
        if ($small == false && $medium == false && $large == false){
            $controller = new UserController();
            $_SESSION['message'] = "Error: Debe aceptar al menos un tamaño <br>";
            $controller->ShowProfileView();
        } else {
            if($this->SizeFinder($_SESSION['userid'])){
                $this->sizeDAO->Remove($_SESSION['userid']);
                $this->Add($small, $medium, $large);
            } else {
                $this->Add($small, $medium, $large);
            }
        }
    }

    public function SizeFinder($userid){
        return $this->sizeDAO->GetByUserid($userid);
    }

    public function getByUserId($userid){
        $sizeDAO = new SizeDAO();
        $size = $sizeDAO->getByUserId($userid);
        if ($size){
            return $size;
        }else{
            return null;
        }
    }

    public function Remove($userid){
        $this->sizeDAO->Remove($userid);
    }

}
?>