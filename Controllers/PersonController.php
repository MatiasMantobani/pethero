<?php

namespace Controllers;

use DAO\DuenoDAO;
use DAO\GuardianDAO;

class PersonController
{

    public function AddPerson()
    {
        require_once(VIEWS_PATH . "user-type.php");
    }

    public function LogInView(){
        require_once(VIEWS_PATH . "login.php");
    }

    public function LogIn($email, $password){
        $guardianes = new GuardianDAO();
        $duenos = new DuenoDAO();
        $usuarios = array();
        $usuarios = array_merge($guardianes->GetAll(), $duenos->GetAll()); // arreglo de todos los usuarios
        // var_dump($usuarios);
        // echo "<br>";
        // recorrer arreglo y buscar por el $mail y $password que llega por parametro
        //cuando lo encontras generas perfil con sus datos

    }

    public function ChooseType($personType)
    {
        if($personType == "guardian"){
            require_once(VIEWS_PATH . "guardian-add.php");
            require_once(VIEWS_PATH . "person-add.php");
        }else{ // $personType == "dueno"
            require_once(VIEWS_PATH . "dueno-add.php");
            require_once(VIEWS_PATH . "person-add.php");
        }
    }
}