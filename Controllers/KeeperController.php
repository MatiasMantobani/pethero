<?php

namespace Controllers;

use DAO\KeeperDAO as KeeperDAO;
use Models\Keeper as Keeper;

class KeeperController
{
    private $keeperDAO;

    public function __construct()
    {
        $this->keeperDAO = new KeeperDAO();
    }

    public function Add($userid)
    {
        $keeper = new Keeper();
        
        $keeper->setUserid($userid);
        $keeper->setPricing(0);
        $keeper->setRating(0);

        $this->KeeperDAO->Add($keeper);


    }
    public function UpdatePricing($pricing)
    {
        $keeper = new Keeper();
        $keeper->setUserid($_SESSION['userid']);
        $keeper->setPricing($pricing);

        $this->keeperDAO->UpdatePricing($keeper);

        $_SESSION['message'] = "Tarifa modificada con éxito";
        $controller = new UserController();
        $controller->ShowProfileView();

    }

    public function UpdateRating()
    {
        echo "<br><br>NO IMPLEMENTADA EN KEEPERDAO <br><br>";

    }

    public function KeeperFinderByUserId($userid)
    {
        return $this->keeperDAO->GetByUserId($userid);
    }

    public function KeeperFinderByKeeperId($keeperid)
    {
        return $this->keeperDAO->GetByKeeperId($keeperid);
    }

    public function GetAll()
    {
        return $this->keeperDAO->GetAll();
    }
}

?>
