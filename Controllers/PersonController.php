<?php

namespace Controllers;

use DAO\DuenoDAO;
use DAO\GuardianDAO;
use Models\Person;

class PersonController
{

    public function AddPerson()
    {
        require_once(VIEWS_PATH . "user-type.php");
    }

    

    

    public function ChooseType($personType)
    {
        if ($personType == "guardian") {
            require_once(VIEWS_PATH . "guardian-add.php");
            require_once(VIEWS_PATH . "person-add.php");
        } else { // $personType == "dueno"
            require_once(VIEWS_PATH . "dueno-add.php");
            require_once(VIEWS_PATH . "person-add.php");
        }
    }
}
