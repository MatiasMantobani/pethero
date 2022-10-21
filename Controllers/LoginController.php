<?php

namespace Controllers;

use Models\Guardian as Guardian;
use Models\Dueno as Dueno;
use DAO\GuardianDAO as GuardianDAO;
use DAO\DuenoDAO as DuenoDAO;


class LoginController
{
    // los atributos y constructor para instanciar a $guardianDAO = new GuardianDAO(); y guardian no andaban (?)

    public function ShowAddViewGuardian()   //cambiar por instanciacion de controlador guardian y madnarlo a list view
    {
        // require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH . "guardian-perfil.php");
    }

    public function LogInView()
    {
        require_once(VIEWS_PATH . "login.php");
    }

    public function LogIn($email, $password)
    {
        $guardianDAO = new GuardianDAO();
        $duenoDAO = new DuenoDAO();

        $usuarios = array();
        $usuarios = array_merge($guardianDAO->GetAll(), $duenoDAO->GetAll()); // arreglo de todos los usuarios

        $hallado = false;
        $user = NULL;
        foreach ($usuarios as $u) {
            // echo "<br> SOY UN INDICE NUEVO <br>";
            if ($email ==  $u->getEmail() && $password == $u->getPassword() && $hallado == false) {
                $user = $u;
                $hallado = true;
            }
        }
        if ($hallado == false) {
            echo '<div class="alert alert-danger text-center" role="alert" >Usuario y/o clave incorrecta. Vuelva a intentarlo...</div>';
            $this->LogInView();
        }

        if ($hallado == true) {
            $_SESSION["loggedUser"] = serialize($user); // No olvidarse de serializar el SESSION    //No se deberia guardar toodo el usuario, solo el id y tipo de usuario (se puede usar para parcial)
            //var_dump($_SESSION);
            if ($user->getTipoDeUsuario() == 2) { // se puede chequear con el atributo tipoDeUsuario! 2 = Guardian
                $this->ShowAddViewGuardian();
            } else {
                require_once(VIEWS_PATH . "dueno-perfil.php"); // conviene con el metodo ShowAddViewDueno?
            }
        }
    }

    public function Logout()
    {
        unset($_SESSION['loggedUser']);
        session_destroy();

        $controller = new HomeController();
        $controller->Index();
    }
}
