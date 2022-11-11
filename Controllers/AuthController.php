<?php

namespace Controllers;

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
        $user = new User();
        $user = $this->userDao->GetByEmail($email);
        if ($user) {
            if ($user->getPassword() == $password) {
                $_SESSION['userid'] = $user->getUserid();
                $_SESSION['type'] = $user->getType();
                $_SESSION['message'] = null;

                $userController = new UserController();
                $userController->ShowProfileView();
            } else {
                $homeController = new HomeController();
                $homeController->Index("Usuario y/o clave incorrectas<br>");
            }
        } else {
            $homeController = new HomeController();
            $homeController->Index("Usuario y/o clave incorrectas<br>");
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

    public function notFound(){
        require_once(VIEWS_PATH . "404.php");
    }
}

?>