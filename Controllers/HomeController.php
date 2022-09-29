<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            // require_once(VIEWS_PATH."guardian-add.php");
            require_once(VIEWS_PATH."main.php");	//AGREGADO
        }        
    }
?>