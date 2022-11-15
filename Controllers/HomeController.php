<?php

namespace Controllers;

use Controllers\UserController as UserController;

class HomeController
{
    static public function Index($message = "")
    {

        if (isset($_SESSION["userid"])) {
            $userController = new UserController();
            $_SESSION['message'][] = $message;
            $userController->ShowProfileView();
        } else {
            require_once(VIEWS_PATH . "index.php");
        }
    }
}
