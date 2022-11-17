<?php

namespace Controllers;

use \Exception as Exception;
use DAO\UserDAO as UserDAO;
use Models\User as User;
use Controllers\AdressController as AdressController;
use Controllers\SizeController as SizeController;
use Controllers\PetController as PetController;
use Controllers\UserImageController as UserImageController;
use Controllers\AvailableDateController as AvailableDate;
use Controllers\KeeperController as KeeperController;
use Controllers\HomeController as HomeController;
use Controllers\MessageController as MessageController;

class UserController
{
    private $userDAO;
    private $keeperController;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->keeperController = new KeeperController();
    }

    public function validate()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }

    
    public function validateOwner()
    {
        if ($_SESSION["type"] == "D") {
            return true;
        } else {
            HomeController::Index("Permisos Insuficientes");
        }
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "user-add.php");
    }

    public function ShowListView()
    {
        if ($this->validate()) {
            try {
                $userList = $this->userDAO->GetAll();
                require_once(VIEWS_PATH . "user-list.php");
            } catch (Exception $ex) {
                HomeController::Index("Error al traer el listado de Usuarios");
            }
        }
    }

    public function ShowAllGuardians()
    {
        if ($this->validate() && $this->validateOwner()) {
            try {
                //solo si guardianes estan activos
                $guardianList = $this->userDAO->GetActiveKeepers();

                // Para evitar mostrar una lista vacia
                if (count($guardianList) > 0) {
                    require_once(VIEWS_PATH . "guardian-list.php");
                } else {
                    MessageController::add("Parece que no hay guardianes por tu zona, intenta de nuevo mas tarde");
                    $userController = new UserController();
                    $userController->ShowProfileView();
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al traer todos los Guardianes");
            }
        }
    }

    //Mostrar perfil de usuario
    public function ShowProfileView()
    {
        if ($this->validate()) {


            // PARA AMBOS
            $user = $this->GetUserById($_SESSION['userid']);

            //trae direccion
            $AdressController = new AdressController();
            $adress = $AdressController->getByUserId($_SESSION['userid']);

            //trae foto de perfil
            $userImageController = new UserImageController();
            $userImage = $userImageController->ShowImage($_SESSION['userid']);

            if ($adress == null) {
                MessageController::add("Para comenzar, debés ingresar tu domicilio");
            }

            //DUEÑO
            if ($_SESSION['type'] == 'D') {
                $petController = new PetController();
                $petList = $petController->GetMyActive($_SESSION['userid']);
                if ($petList == null) {
                    MessageController::add("No olvides cargar tus mascotas");
                }
            }

            //GUARDIAN
            if ($_SESSION['type'] == 'G') {

                // Mostrar primer y ultima fecha disponible
                $availableDate = new AvailableDate();
                $AvailableDateList = $availableDate->GetByUserId($_SESSION['userid']);

                if($AvailableDateList == null){
                    MessageController::add("Para aceptar reservas debes indicar tu disponibilidad");
                }

                $unicaFecha = null;
                $firstDate = null;
                $lastDate = null;
                if ($AvailableDateList) {
                    if (count($AvailableDateList) == 1) {
                        $unicaFecha = $AvailableDateList[0]->getDate();
                    }
                    $firstDate = $AvailableDateList[0]->getDate();
                    $lastDate = $AvailableDateList[count($AvailableDateList) - 1]->getDate();
                }


                //tamaños aceptados
                $SizeController = new SizeController();
                $size = $SizeController->getByUserId($_SESSION['userid']);
                if ($size == null) {
                    MessageController::add("Para cuidar mascotas, debés cargar el tamaño que aceptas");
                }

                //rating
                $reviewController = new ReviewController();
                $reviewCounter = $reviewController->GetReviewCounter($_SESSION['userid']);
                $finalRating = $reviewController->GetFinalScore($_SESSION['userid'], $reviewCounter);

                //remuneracion y creacion de keeper
                $keeper = $this->keeperController->getByUserId($_SESSION['userid']);
                if ($keeper == null) {
                    MessageController::add("Agregue una remuneracion diferente a 0 para comenzar");
                    $keeper = $this->keeperController->Add($_SESSION['userid']);    //si keeper no existe lo crea
                } else {
                    if ($keeper->getPricing() == 0) {
                        MessageController::add("Agregue una remuneracion diferente a 0 para comenzar");
                    }
                }
            }
            $messages = MessageController::getAll();
            MessageController::clear();

            $this->validateStatus();    // Checks for adress and pets for owner and keeper
            require_once(VIEWS_PATH . "user-profile.php");
        }
    }


    public function Add($email, $password, $type, $dni, $cuit, $name, $surname, $phone)
    {
        // if ($this->validate()) { //no se valida porque cuando se crea no esta logueado
        try {
            $user = new User();
            $user->setEmail($email);    //es unique, hay que chequear antes de guardar en BD
            $user->setPassword($password);
            $user->setType($type);
            $user->setDni($dni);    //es unique
            $user->setCuit($cuit);  //es unique
            $user->setname($name);
            $user->setSurname($surname);
            $user->setPhone($phone);

            $controller = new HomeController();
            if ($this->userDAO->ValidateUniqueEmail($email) || $this->userDAO->ValidateUniqueDni($dni) || $this->userDAO->ValidateUniqueCuit($cuit)) {  //validar que no haya repeticiones de atributos UNIQUE
                $controller->Index("Algunos de los datos ya estan en uso por otro usuario");
            } else {
                $this->userDAO->Add($user);
                //aca no se puede crear un keeper porque aun no hay userid ni $_SESSION['userid']
                $controller->Index("Usuario registrado con exito");
            }
        } catch (Exception $ex) {
            HomeController::Index("Error al crear el Usuario");
        }
        // }
    }

    public function validateStatus()
    {
        if ($this->validate()) {

            //AMBOS
            $adressController = new AdressController();
            $adress = $adressController->getByUserId($_SESSION['userid']);

            // DUEÑO
            if ($_SESSION['type'] == 'D') {
                $petController = new PetController();
                $flag = 0;
                $petList = $petController->GetMyActive($_SESSION['userid']);    //trae las mascotas ACTIVAS (con carnet)
                if ($petList && $adress) {
                    $this->UpdateStatus(1);
                } else {
                    $this->UpdateStatus(0);
                }
            }

            // GUARDIAN
            if ($_SESSION['type'] == 'G') {
                $keeper = $this->keeperController->getByUserId($_SESSION['userid']);
                $sizeFlag = 0;
                if ($keeper != null) {
                    $sizes = new SizeController();
                    $size = $sizes->getByUserId($_SESSION['userid']);
                    if ($size != null) {
                        if ($size->getSmall() == 1 || $size->getMedium() == 1 || $size->getLarge() == 1) {
                            $sizeFlag = 1;
                        }
                    }
                    $dates = new AvailableDateController();
                    $dateList = $dates->GetByUserId($_SESSION['userid']);
                    $dateFlag = 0;
                    $dateNow = date('Y-m-d');
                    if ($dateList != null) {
                        foreach ($dateList as $date) {
                            if ($date->getDate() > $dateNow) {
                                $dateFlag = 1;
                            }
                        }
                    }
                }

                if ($keeper->getStatus() == 1  && $sizeFlag == 1 && $dateFlag == 1 && $adress != null) {
                    $this->UpdateStatus(1);
                } else {
                    $this->UpdateStatus(0);
                }
            }
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
        if ($this->validate()) {
            try {
                $user = new User();
                $user->setUserid($_SESSION['userid']);
                $user->setName($name);
                $user->setSurname($surname);
                $user->setPhone($phone);
                if ($user != null) {
                    $this->userDAO->Update($user);
                    $this->ShowProfileView();
                } else {
                    MessageController::add("Error al actualizar los datos");
                    $this->ShowProfileView();
                }
            } catch (Exception $ex) {
                HomeController::Index("Error al intentar actualizar el Usuario");
            }
        }
    }

    public function UpdateStatus($status)
    {
        if ($this->validate()) {
            try {
                $user = new User();
                $user->setUserid($_SESSION['userid']);
                $user->setStatus($status);

                $this->userDAO->UpdateStatus($user);
            } catch (Exception $ex) {
                HomeController::Index("Error al intentar actualizar el estado del Usuario");
            }
        }
    }

    public function GetUserById($userid)
    {
        if ($this->validate()) {
            try {
                $user = $this->userDAO->GetById($userid);
                return $user;
            } catch (Exception $ex) {
                HomeController::Index("Error al traer el Usuario solicitado");
            }
        }
    }

    public function ShowExternalProfile($keeperid)
    {
        if ($this->validate() && $this->validateOwner()) {
            $keeper = $this->keeperController->getByKeeperId($keeperid); // para la info especifica del guardian
            $user = $this->GetUserById($keeperid);  // para la info especifica del user

            $reviewController = new ReviewController();
            $reviewCounter = $reviewController->GetReviewCounter($keeperid);
            $finalRating = $reviewController->GetFinalScore($keeperid, $reviewCounter);

            $userImageController = new UserImageController();
            $userImage = $userImageController->ShowImage($keeperid);

            $SizeController = new SizeController();
            $size = $SizeController->getByUserId($keeperid);

            require_once(VIEWS_PATH . "external-profile.php");
        }
    }
}
