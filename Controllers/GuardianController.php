<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;
use Models\Guardian as Guardian;

class GuardianController
{
    private $guardianDAO;

    public function __construct()
    {
        $this->guardianDAO = new GuardianDAO();
    }

    public function ShowAddView()
    {
        // require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "guardian-add.php");
    }

    public function ShowListView()
    {
        // require_once(VIEWS_PATH . "validate-session.php");
        $guardianList = $this->guardianDAO->GetAll();   // guardianList lo usa guardian-list.php en el foreach($guardianList as $guardian)
        require_once(VIEWS_PATH . "guardian-list.php");
    }

    public function Remove($dni)
    {
        // require_once(VIEWS_PATH."validate-session.php");

        $this->guardianDAO->Remove($dni);

        $this->ShowListView();
    }

    public function ShowDisponibilidadView(){
        // require_once(VIEWS_PATH."validate-session.php");
        // require_once(VIEWS_PATH."validate-session-guardian.php");
        require_once(VIEWS_PATH . "disponibilidad-view.php");
    }

    // pasar a DAO parte
    public function ModifyDisponibilidad($lunes = "", $martes = "", $miercoles = "", $jueves = "", $viernes = "", $sabado = "", $domingo = ""){

        $disponibilidadActualizada = $lunes.$martes.$miercoles.$jueves.$viernes.$sabado.$domingo;
        var_dump($disponibilidadActualizada);
        echo "<br>";
        $guardian = new Guardian();
        $guardian = unserialize($_SESSION["loggedUser"]);


        var_dump($guardian);
        $guardian->setDisponibilidad($disponibilidadActualizada);


        $this->guardianDAO->Remove($guardian->getDni());
        $this->guardianDAO->Add($guardian);


    }

    public function Add($firstName, $lastName, $dni, $adress, $telephone, $email, $password, $cuil, $remuneracion, $tamanoDeMascota)
    {
        // require_once(VIEWS_PATH . "validate-session.php");

        $guardian = new Guardian();

        $guardian->setFirstName($firstName);
        $guardian->setLastName($lastName);
        $guardian->setDni($dni);
        $guardian->setAdress($adress);
        $guardian->setTelephone($telephone);
        $guardian->setEmail($email);
        $guardian->setPassword($password);
        $guardian->setCuil($cuil);
        $guardian->setRemuneracion($remuneracion);
        $guardian->setTamanoDeMascota($tamanoDeMascota);

        $this->guardianDAO->Add($guardian);

        $this->ShowListView();
        // require_once(VIEWS_PATH . "guardian-perfil.php");
    }
}
