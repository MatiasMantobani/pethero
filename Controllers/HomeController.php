<?php

namespace Controllers;

use Controllers\UserController as UserController;

class HomeController
{
    static public function Index($message = "")
    {
        if (isset($_SESSION["userid"])) {
            if($message != "") {
                $_SESSION['message'][] = $message;
            }
            $userController = new UserController();
            $userController->ShowProfileView();
        } else {
            require_once(VIEWS_PATH . "index.php");
        }
    }
}
