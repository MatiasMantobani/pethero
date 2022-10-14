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

    public function ShowProfileView()
    {
        // require_once(VIEWS_PATH . "validate-session.php");
        $person = unserialize($_SESSION['loggedUser']);
        if($person->getTipoDeUsuario() == 1)
        {
            require_once(VIEWS_PATH . "dueno-perfil.php");
        }
        else if ($person->getTipoDeUsuario() == 2)
        {
            require_once(VIEWS_PATH . "guardian-perfil.php");
        }
    }

}
