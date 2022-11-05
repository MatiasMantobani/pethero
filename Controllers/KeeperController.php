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

        $this->keeperDAO->Add($keeper);

        return $this->getByUserId($userid);  //solo se usa una vez al crear perfil

    }

    public function ShowUpdatePricingView(){
        $keeper = $this->getByUserId($_SESSION['userid']);
        require_once(VIEWS_PATH . "pricing-update.php");
    }

    public function UpdatePricing($pricing)
    {

        $keeper = new Keeper();
        $keeper->setUserid($_SESSION['userid']);
        $keeper->setPricing($pricing);

        $this->keeperDAO->UpdatePricing($keeper);
        
        $this->UpdateStatus(1);

        $_SESSION['message'] = "Tarifa modificada con éxito";
        $controller = new UserController();
        $controller->ShowProfileView();

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

        $_SESSION['message'] = "El usuario fue actualizado con éxito";
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
