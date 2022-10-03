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

    public function LogInView()
    {
        require_once(VIEWS_PATH . "login.php");
    }

    public function LogIn($email, $password)
    {
        $guardianes = new GuardianDAO();
        $duenos = new DuenoDAO();
        $usuarios = array();
        $usuarios = array_merge($guardianes->GetAll(), $duenos->GetAll()); // arreglo de todos los usuarios
        // var_dump($usuarios);
        // print_r($usuarios);
        echo "<br>";

        $hallado = false;
        $user=NULL;
        foreach ($usuarios as $u) {
            // echo "<br>INDICE DEL ARREGLO <br>";
            if ($email ==  $u->getEmail() && $password == $u->getPassword() && $hallado==false) {
                $user=$u;
                $hallado = true;
                // echo "El usuario existe y es: ";
                // var_dump($u);   //guardar en session usuario que se loguea
                // echo "<br>";
            }
        }
        if ($hallado == false) {
            echo "<br>El usuario no existe o la contraseña no es valida <br>";  //darle formato lindo
            require_once(VIEWS_PATH . "login.php");
        }
        if ($hallado == true) {
            var_dump($user);
        }

                


        // ESTO NO ANDA
        // // recorrer arreglo y buscar por el $mail y $password que llega por parametro 
        // $jsonContent = json_encode($usuarios, JSON_PRETTY_PRINT);
        // file_put_contents('Data/arregloLogin.json', $jsonContent);

        //cuando lo encontras generas perfil con sus datos

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
