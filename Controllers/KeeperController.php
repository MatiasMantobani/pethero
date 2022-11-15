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

    // It validates keeper table on db, pricing, userid, rating, adress & availability from keeper througt $userid
//    public function validateKeeper($userid){
//        $keeper = $this->getByUserId($userid);
//
//        if ($keeper->getPricing() > 0){
//                $this->UpdateStatus(1);
//                return 1;
//
//        } else {
//            $this->UpdateStatus(0);
//            return 0;
//        }
//    }

    public function Add($userid)
    {
        $keeper = new Keeper();
        $keeper->setUserid($userid);

        $this->keeperDAO->Add($keeper);

        return $this->getByUserId($userid);  //solo se usa una vez al crear perfil

    }

    public function ShowUpdatePricingView(){
        $keeper = $this->getByUserId($_SESSION['userid']);
        require_once(VIEWS_PATH . "pricing-update.php");
    }

    public function UpdatePricing($pricing)
    {
        $controller = new UserController();

        if($pricing > 0){
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
    }

    public function getPricingByUserId($userid){
        return $this->getByUserId($userid)->getPricing();
    }

    public function UpdateStatus($status)
    {
        $keeper = new Keeper();
        $keeper->setUserid($_SESSION['userid']);
        $keeper->setStatus($status);

        $this->keeperDAO->UpdateStatus($keeper);;

        $controller = new UserController();
        $controller->ShowProfileView();

    }

    public function GetAll()
    {
        return $this->keeperDAO->GetAll();
    }

    public function KeeperFinderByUserId($userid)
    {
        return $this->keeperDAO->GetByUserId($userid);
    }

    public function KeeperFinderByKeeperId($keeperid)
    {
        return $this->keeperDAO->GetByKeeperId($keeperid);
    }

    public function getByKeeperId($keeperid){
        return $this->keeperDAO->GetByKeeperId($keeperid);
    }


    public function getByUserId($userid){
        return $this->keeperDAO->GetByUserId($userid);
    }

}

?>
