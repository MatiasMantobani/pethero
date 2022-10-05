<?php

namespace Controllers;

use Models\Guardian as Guardian;
use DAO\GuardianDAO as GuardianDAO;
use DAO\DuenoDAO as DuenoDAO;

class HomeController
{
    public function Index($message = "")
    {
        // require_once(VIEWS_PATH."guardian-add.php");
        require_once(VIEWS_PATH . "main.php");    //AGREGADO
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
        $user = NULL;
        foreach ($usuarios as $u) {
            // echo "<br>INDICE DEL ARREGLO <br>";
            if ($email ==  $u->getEmail() && $password == $u->getPassword() && $hallado == false) {



                $user = $u;
                $hallado = true;
                // echo "El usuario existe y es: ";
                // var_dump($u);   //guardar en session usuario que se loguea
                // echo "<br>";
            }
        }
        if ($hallado == false) {
            echo '<div class="alert alert-danger text-center" role="alert" >Usuario y/o clave incorrecta.</div>';
            $this->LogInView();
        }

        if ($hallado == true) {
            $_SESSION["loggedUser"] = $user;
            var_dump($_SESSION);
            if ($user instanceof Guardian) {
                require_once(VIEWS_PATH . "guardian-perfil.php");
            }
        }




        // ESTO NO ANDA
        // // recorrer arreglo y buscar por el $mail y $password que llega por parametro 
        // $jsonContent = json_encode($usuarios, JSON_PRETTY_PRINT);
        // file_put_contents('Data/arregloLogin.json', $jsonContent);

        //cuando lo encontras generas perfil con sus datos

    }




    public function Logout()
    {
        session_destroy();

        $this->Index();
    }
}
