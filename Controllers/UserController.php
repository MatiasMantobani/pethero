<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\User as User;
use Controllers\AuthController as AuthController;
use Controllers\AdressController as AdressController;
use Controllers\SizeController as SizeController;
use Controllers\PetController as PetController;
use Controllers\BreedController as BreedController;
use Controllers\UserImageController as UserImageController;
use Controllers\AvailableDateController as AvailableDate;
use Controllers\KeeperController as KeeperController;
use Controllers\ReserveController as ReserveController;
use Controllers\HomeController as HomeController;

class UserController
{
    private $userDAO;
    private $keeperController;
    // private $reserveController;
    // private $availableDateController;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->keeperController = new KeeperController();
        // $this->reserveController = new ReserveController();  //Rompe
        //$this->availableDateController = new AvailableDate();  //Rompe
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "user-add.php");
    }

    public function ShowListView()
    {
        $userList = $this->userDAO->GetAll();
        require_once(VIEWS_PATH . "user-list.php");
    }

    public function ShowAllGuardians(){
        $guardianList = $this->userDAO->GetAllKeepers();
        require_once(VIEWS_PATH . "guardian-list.php");
    }

    //Mostrar perfil de usuario
    public function ShowProfileView()
    {
        $user = $this->GetUserById($_SESSION['userid']);

        $AdressController = new AdressController();
        $adress = $AdressController->getByUserId($_SESSION['userid']);

        $userImageController = new UserImageController();
        $userImage = $userImageController->ShowImage($_SESSION['userid']);

        if ($_SESSION['type'] == 'D') {
            $petController = new PetController();
            $petList = $petController->GetByUserId($_SESSION['userid']);

            if ($petList != null) {
                $breedController = new BreedController();
            }
        }

        if ($_SESSION['userid']) {
            if ($adress == null) {
                $_SESSION['message'] .= "Para comenzar, debés ingresar tu domicilio. <br>";
            }
        }

        //si es Guardian
        if ($_SESSION['type'] == 'G') {
            $SizeController = new SizeController();
            $size = $SizeController->getByUserId($_SESSION['userid']);
            if ($size == null) {
                $_SESSION['message'] .= "Para cuidar mascotas, primero debés cargar el tamaño que aceptas. <br>";
            }
            $availableDate = new AvailableDate();
            $fechas = $availableDate->GetById();

        }

        // Manda keeper al perfil
        if ($_SESSION['type'] == 'G') {
            $keeper = $this->keeperController->getByUserId($_SESSION['userid']);
            if ($keeper == null){
                $_SESSION['message'] .= "Falta cargar precio. <br>";
                $keeper = $this->keeperController->Add($_SESSION['userid']);
            } else {
                if ($keeper->getPricing() == 0){
                    $_SESSION['message'] .= "Falta cargar tarifa. <br>";
                }
            }
        }

        if ($_SESSION['type'] == 'D') {
            $userList = $this->userDAO->GetAll(); // Envia la lista de guardianes al perfil de dueño
        }

        // Conseguir todas las reservas y todos los pagos
        if ($_SESSION['userid']) {
            $reserveController = new ReserveController();
            $reserveList = $reserveController->getMyReserves();

            $paymentController = new PaymentController();
            $pagos = $paymentController->getMyPayments();

        }

        $this->validateStatus(); // Checks for adress and pets for owner
        require_once(VIEWS_PATH . "user-profile.php");
    }

    public function validateStatus(){
        $adressController = new AdressController();
        $adress = $adressController->getByUserId($_SESSION['userid']);

        if ($_SESSION['type'] == 'D'){
            $petController = new PetController();
            $flag = 0;
            $petList = $petController->GetByUserId($_SESSION['userid']);
            if ($petList != null){
                foreach ($petList as $pet){
                    if ($pet->getStatus() == "1"){
                        $flag = 1;
                    }
                }
            }
            if ($flag == 1 && $adress != null){
                $this->UpdateStatus(1);
            } else {
                $this->UpdateStatus(0);
            }
        }

        if ($_SESSION['type'] == 'G'){
            $keeper = $this->keeperController->getByUserId($_SESSION['userid']);
            $sizeFlag = 0;
            if($keeper != null){
                $sizes = new SizeController();
                $size = $sizes->getByUserId($_SESSION['userid']);
                if($size != null){
                    if($size->getSmall() == 1 || $size->getMedium() == 1 || $size->getLarge() == 1){
                        $sizeFlag = 1;
                    }
                }
                $dates = new AvailableDateController();
                $dateList = $dates->GetByUserId($_SESSION['userid']);
                $dateFlag = 0;
                $dateNow = date('Y-m-d');
                if ($dateList != null){
                    foreach ($dateList as $date){
                        if($date->getDate() > $dateNow){
                            $dateFlag = 1;
                        }
                    }
                }
            }

            if ($keeper->getPricing() > 0 && $sizeFlag == 1 && $dateFlag == 1 && $adress != null){
                $this->UpdateStatus(1);
            } else {
                $this->UpdateStatus(0);
            }
        }

    }

    public function Add($email, $password, $type, $dni, $cuit, $name, $surname, $phone)
    {

        $user = new User();

        $user->setEmail($email);    //es unique
        $user->setPassword($password);
        $user->setType($type);
        $user->setDni($dni);    //es unique, hay que chequear antes de guardar en BD
        $user->setCuit($cuit);  //es unique
        $user->setname($name);
        $user->setSurname($surname);
        $user->setPhone($phone);

        $controller = new HomeController();
        //validar que no haya repeticiones de atributos UNIQUE
        if ($this->userDAO->ValidateUniqueEmail($email) || $this->userDAO->ValidateUniqueDni($dni) || $this->userDAO->ValidateUniqueCuit($cuit)) {
            $controller->Index("Algunos de los datos ya estan en uso por otro usuario");
        } else {
            $this->userDAO->Add($user);
            $controller->Index("Usuario registrado con exito");
        }

    }

    public function ShowUpdateView()
    {
        $user = new User();
        $user = $this->GetUserById($_SESSION['userid']);
        if ($user != null) {
            require_once(VIEWS_PATH . "user-update.php");
        }
    }

    public function Update($name, $surname, $phone)
    {
        $user = new User();
        $user->setUserid($_SESSION['userid']);
        $user->setName($name);
        $user->setSurname($surname);
        $user->setPhone($phone);
        if ($user != null) {
            $this->userDAO->Update($user);
            $this->ShowProfileView();
        } else {
            $_SESSION['message'] = "Error al actualizar datos <br>";
            $this->ShowProfileView();
        }
    }

    public function UpdateStatus($status)
    {
        $user = new User();
        $user->setUserid($_SESSION['userid']);
        $user->setStatus($status);

        $this->userDAO->UpdateStatus($user);
    }

    public function GetUserById($userid)
    {
        $user = $this->userDAO->GetById($userid);
        return $user;
    }

    public function ShowExternalProfile(){
        require_once(VIEWS_PATH . "external-profile.php");
    }
}
