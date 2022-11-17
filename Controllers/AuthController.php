<?php

namespace Controllers;

use \Exception as Exception;
use DAO\UserDAO as UserDAO;
use Controllers\UserController as UserController;
use Controllers\HomeController as HomeController;
use Controllers\MessageController as MessageController;

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
                MessageController::add("Bienvenide!");

                $userController = new UserController();
                $userController->ShowProfileView();
            } else {
                HomeController::Index("Usuario y/o clave incorrectas");
            }
        } catch (Exception $ex) {
            HomeController::Index("Error al Loguearse");
        }
    }


    public function Logout()
    {
        unset($_SESSION['userid']);
        unset($_SESSION['type']);
        MessageController::clear();
        session_destroy();

        HomeController::Index("Te deslogueaste correctamente");
    }

    public function notFound()
    {
        require_once(VIEWS_PATH . "404.php");
    }
}

