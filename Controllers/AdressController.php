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

        public function ShowAddView()
        {
            $adress2 = $this->getByUserId($_SESSION['userid']);
            require_once(VIEWS_PATH."adress-add.php");
        }

        public function ShowListView()
        {
            $adressList = $this->adressDAO->GetAll();
            require_once(VIEWS_PATH."adress-list.php");
        }

        public function Add($street, $number, $floor, $department, $postalcode)
        {
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
        }

        public function Update($street, $number, $floor, $department, $postalcode){
            if($this->AdressFinder($_SESSION['userid'])){
                $this->adressDAO->Update($_SESSION['userid'], $street, $number, $floor, $department, $postalcode);

                $_SESSION['message'] = "Domicilio modificado con exito<br>";

                $controller = new UserController();
                $controller->ShowProfileView();
            } else {
                $this->Add($street, $number, $floor, $department, $postalcode);
            }
        }

        public function AdressFinder($userid){
            return $this->adressDAO->GetByUserid($userid);
        }

        public function getByUserId($userid){
            $adressDAO = new AdressDAO();
            $adress = $adressDAO->getByUserId($userid);
            if ($adress){
                return $adress;
            }else{
                return null;
            }
        }

        public function Remove($userid){
            $this->adressDAO->Remove($userid);
        }

    }
?>