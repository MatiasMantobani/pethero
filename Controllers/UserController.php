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

class UserController
{
    private $userDAO;
    private $keeperController;
    // private $reserveController;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->keeperController = new KeeperController();
        // $this->reserveController = new ReserveController();  //Rompe
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

    //Mostrar perfil de usuario
    public function ShowProfileView()
    {
        $userList = $this->userDAO->GetAll();

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
                $_SESSION['message'] .= "Para comenzar, debés ingresar tu domicilio. ";
            }
        }

        //si es Guardian
        if ($_SESSION['type'] == 'G') {
            $SizeController = new SizeController();
            $size = $SizeController->getByUserId($_SESSION['userid']);
            if ($size == null) {
                $_SESSION['message'] .= "Para cuidar mascotas, primero debés cargar el tamaño que aceptas. ";
            }
            $availableDate = new AvailableDate();
            $fechas = $availableDate->GetById();
        }


        if ($_SESSION['type'] == 'D') {
            $availableDate2 = new AvailableDate();
            $consultaList = $availableDate2->getAvailablesListByDatesAndBreed(11, "2022-11-20", "2022-11-23");    //VALORES FIJOS TEST //VER SI TODAVIA SE USA
        }


        // Conseguir todas las reservas
        if ($_SESSION['userid']) {
            $reserveController = new ReserveController();
            $reserveList = $reserveController->getMyReserves();
            // foreach($reserveList as $reserva){
            //     // echo $reserva->getReserveid(). "<br>";
            // }
        }

        require_once(VIEWS_PATH . "user-profile.php");
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

        //validar que no haya repeticiones de atributos UNIQUE
        if ($this->userDAO->ValidateUniqueEmail($email) || $this->userDAO->ValidateUniqueDni($dni) || $this->userDAO->ValidateUniqueCuit($cuit)) {

            $controller = new HomeController();
            $controller->Index("Algunos de los datos ya estan en uso por otro usuario");
        } else {
            $this->userDAO->Add($user);

            if ($user->getType() == "G") {
                $keeper = $this->userDAO->GetByEmail($email);
                if ($keeper != null) {
                    var_dump($keeper->getEmail());
                    $this->keeperController->Add($keeper->getEmail());  //$keeper->getEmail() (?)
                }
            }
        }



        $controller = new AuthController();
        $controller->Login($email, $password);
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
            $_SESSION['message'] = "Error al actualizar datos";
            $this->ShowProfileView();
        }
    }

    public function GetUserById($userid)
    {
        $user = $this->userDAO->GetById($userid);
        return $user;
    }
}
