<?php

namespace Controllers;

use Models\Guardian as Guardian;
use DAO\GuardianDAO as GuardianDAO;
use DAO\DuenoDAO as DuenoDAO;

class HomeController
{
    public function Index($message = "")    //el nombre Index esta definido en framework: Config/Request.php
    {
        require_once(VIEWS_PATH . "main.php");    //Vista por default de la pagina
    }

   
}
