<?php

namespace Controllers;

use \Exception as Exception;
use Models\User as User;
use DAO\UserDAO as UserDAO;
use Controllers\UserController as UserController;
use Controllers\HomeController as HomeController;

class AuthController
{

    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDAO();
    }


    public function Login($email, $password)
    {
        try {
            $user = $this->userDao->Login($email, $password);

            if ($user) {
                $_SESSION['userid'] = $user->getUserid();
                $_SESSION['type'] = $user->getType();
                $_SESSION['message'] = array();

                $userController = new UserController();
                $userController->ShowProfileView();
            } else {
                $homeController = new HomeController();
                $homeController->Index("Usuario y/o clave incorrectas<br>");
            }
        } catch (Exception $ex) {
            // var_dump($ex);
            $_SESSION["message"] = "Error al Loguearse";
        }
    }

    public function Logout()
    {
        unset($_SESSION['userid']);
        unset($_SESSION['type']);
        unset($_SESSION['message']);
        session_destroy();

        $controll = new HomeController();
        $controll->Index("Cierre de sesión correcto<br>");
    }

    public function notFound()
    {
        require_once(VIEWS_PATH . "404.php");
    }
}

/*
try {
} catch (Exception $ex) {
// var_dump($ex);
HomeController::Index("Error al ... De Autentificar");
}

*/
