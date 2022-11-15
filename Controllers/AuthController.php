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
                $_SESSION['message'] = [];

                $userController = new UserController();
                $userController->ShowProfileView();
            } else {
                $homeController = new HomeController();
                $homeController->Index("Usuario y/o clave incorrectas<br>");
            }
        } catch (Exception $ex) {
            HomeController::Index("Error al Loguearse");
        }
    }


    public function Logout()
    {
        unset($_SESSION['userid']);
        unset($_SESSION['type']);
        unset($_SESSION['message']);
        session_destroy();

        HomeController::Index("Te deslogueaste correctamente");
    }

    public function notFound()
    {
        require_once(VIEWS_PATH . "404.php");
    }
}

/*
try {
} catch (Exception $ex) {
HomeController::Index("Error al ... Autentificar");
}

*/
