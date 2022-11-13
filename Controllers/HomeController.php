<?php
    namespace Controllers;

    use Controllers\UserController as UserController;

    class HomeController
    {
        static public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        }

    }
?>