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
    
    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."user-add.php");
        }

        public function ShowListView()
        {
            $userList = $this->userDAO->GetAll();
            require_once(VIEWS_PATH."user-list.php");
        }

        public function ShowProfileView()
        {
            $userList = $this->userDAO->GetAll();

            $user = $this->GetUserById($_SESSION['userid']);

            $AdressController = new AdressController();
            $adress = $AdressController->getByUserId($_SESSION['userid']);

            $userImageController = new UserImageController();
            $userImage = $userImageController->ShowImage($_SESSION['userid']);

            if ($_SESSION['type'] == 'D'){
                $petController = new PetController();
                $petList = $petController->GetByUserId($_SESSION['userid']);

                if ($petList != null){
                    $breedController = new BreedController();
                }
            }


            if ($_SESSION['userid']) {
                if ($adress == null){
                    $_SESSION['message'] .= "Para comenzar, debés ingresar tu domicilio. ";
                }
            }

            if ($_SESSION['type'] == 'G') {
                $SizeController = new SizeController();
                $size = $SizeController->getByUserId($_SESSION['userid']);
                if ($size == null){
                    $_SESSION['message'] .= "Para cuidar mascotas, primero debés cargar el tamaño que aceptas. ";
                }
                $availableDate = new AvailableDate();
                $fechas = $availableDate->GetById();
            }

            require_once(VIEWS_PATH."user-profile.php");
        }

        public function Add($email, $password, $type, $dni, $cuit, $name, $surname, $phone)
        {
            $user = new User();

            $user->setEmail($email);
            $user->setPassword($password);
            $user->setType($type);
            $user->setDni($dni);
            $user->setName($name);
            $user->setCuit($cuit);
            $user->setSurname($surname);
            $user->setPhone($phone);

            $this->userDAO->Add($user);

            $controller = new AuthController();
            $controller->Login($email, $password);

        }

        public function GetUserById($userid)
        {
            $user = $this->userDAO->GetById($userid);
            return $user;
        }

    }
?>