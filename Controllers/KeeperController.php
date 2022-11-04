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
        $this->keeperDAO->UpdatePricing($pricing, $_SESSION['userid']);

        $_SESSION['message'] = "Tarifa modificada con éxito";

        $controller = new UserController(); // OVERLAP ???
        $controller->ShowProfileView(); //OVERLAP ??? 

    }
    public function UpdateRating()
    {
        echo "<br><br>NO IMPLEMENTADA EN KEEPERDAO <br><br>";

    }

    public function KeeperFinder($userid)
    {
        return $this->keeperDAO->GetByUserid($userid);
    }
}

?>
